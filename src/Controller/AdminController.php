<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Page;
use App\Entity\Track;
use App\Form\NewImageType;
use App\Form\NewPageType;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/connect")
 * @Security("is_granted('ROLE_USER')")
 */
class AdminController extends AbstractController
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @Route("/dashboard/", name="dashboard")
     * @Route("/dashboard")
     */
    public function dashboardAction(): Response
    {
        $date = new DateTime();

        $referers = $this->doctrine->getRepository(Track::class)
            ->createQueryBuilder('t')
            ->select('DISTINCT(t.previousPage) as previousPage, count(DISTINCT CONCAT(t.previousPage, t.ip)) as nbrPreviousPage')
            ->groupBy('previousPage')
            ->where('t.saveAt < :date')
            ->setParameters(['date' => $date])
            ->orderBy('nbrPreviousPage', 'DESC')
            ->getQuery()
            ->getResult();

        $computers = $this->doctrine->getRepository(Track::class)
            ->createQueryBuilder('t')
            ->select('DISTINCT(t.computer) as computer, count(DISTINCT CONCAT(t.computer, t.ip)) as nbrComputer')
            ->groupBy('computer')
            ->where('t.saveAt < :date')
            ->setParameters(['date' => $date])
            ->orderBy('nbrComputer', 'DESC')
            ->getQuery()
            ->getResult();

        $pages = $this->doctrine->getRepository(Track::class)
            ->createQueryBuilder('t')
            ->select('DISTINCT(t.page) as page, count(t.page) as nbrPage')
            ->groupBy('page')
            ->where('t.saveAt < :date')
            ->setParameters(['date' => $date])
            ->orderBy('nbrPage', 'DESC')
            ->getQuery()
            ->setMaxResults(10)
            ->getResult();

        $uniquePages = $this->doctrine->getRepository(Track::class)
            ->createQueryBuilder('t')
            ->select('DISTINCT(t.page) as uniquePage, count(DISTINCT CONCAT(t.page, t.ip)) as nbrPage')
            ->groupBy('uniquePage')
            ->where('t.saveAt < :date')
            ->setParameters(['date' => $date])
            ->orderBy('nbrPage', 'DESC')
            ->getQuery()
            ->setMaxResults(10)
            ->getResult();

        $ip = $this->doctrine->getRepository(Track::class)
            ->createQueryBuilder('t')
            ->select('count(DISTINCT t.ip) as nbrIp')
            ->where('t.saveAt < :date')
            ->setParameters(['date' => $date])
            ->getQuery()
            ->getSingleScalarResult();

        return $this->render('admin/dashboard.html.twig', [
            'referers' => $referers,
            'computers' => $computers,
            'pages' => $pages,
            'uniquePages' => $uniquePages,
            'ip' => $ip,
        ]);
    }

    /**
     * @Route("/newsletter/", name="newsletter")
     * @Route("/newsletter")
     */
    public function newsletterAction(): Response
    {
        return $this->render('admin/newsletter.html.twig');
    }

    /**
     * @Route("/modify/", name="modify")
     * @Route("/modify")
     */
    public function modifyAction(Request $request): Response
    {
        $form_newPage = $this->createForm(NewPageType::class, new Page);
        $form_newPage->handleRequest($request);

        if (($form_newPage->isSubmitted() && $form_newPage->isValid())) {
            $em = $this->doctrine->getManager();
            $page = $form_newPage->getData();

            $em->persist($page);
            $em->flush();
            return $this->redirectToRoute('modify');
        }
        $menuInfos = $this->menuAction();

        return $this->render('admin/modify.html.twig', [
            'form_newPage' => $form_newPage->createView(),
            'menuInfos' => $menuInfos
        ]);
    }

    /**
     * @Route("/edition-page/{page}", name="edit_page", requirements={"page"="\d+"})
     */
    public function editPageAction(Request $request, SluggerInterface $slugger, Page $page): Response
    {
        $image = new Image();
        $form_newImage = $this->createForm(NewImageType::class, $image);
        $form_newImage->handleRequest($request);

        if (($form_newImage->isSubmitted() && $form_newImage->isValid())) {
            $em = $this->doctrine->getManager();
            $imageFile = $form_newImage->get('imageFile')->getData();
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('img'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                $img = null;
                $info = getimagesize('img/' . $newFilename);
                if ($info['mime'] == 'image/jpeg')
                    $img = imagecreatefromjpeg('img/' . $newFilename);
                elseif ($info['mime'] == 'image/gif') {
                    $img = imagecreatefromgif('img/' . $newFilename);
                } elseif ($info['mime'] == 'image/png') {
                    $img = imagecreatefrompng('img/' . $newFilename);
                }
                if ($img) {
                    imagepalettetotruecolor($img);
                    imagealphablending($img, true);
                    imagesavealpha($img, true);
                    imagewebp($img, 'img/' . $newFilename.'.webp', 100);
                    imagedestroy($img);
                    unlink('img/' . $newFilename);
                    $image->setName($newFilename.'.webp');
                } else {
                    $image->setName($newFilename);
                }
            }
            $image->setPage($page);

            $em->persist($image);
            $em->flush();

            return $this->redirectToRoute('edit_page', ['page' => $page->getId()]);
        }

        $imageInfos = $this->doctrine->getRepository(Image::class)
            ->createQueryBuilder('i')
            ->join('i.page', 'p')
            ->select('i.name, i.position, i.id')
            ->where('p.position =:position')
            ->setParameters(['position' => $page->getPosition()])
            ->orderBy('i.position', 'ASC')
            ->getQuery()
            ->getResult();

        $menuInfos = $this->menuAction();

        return $this->render('admin/edit_page.html.twig', [
            'form_newImage' => $form_newImage->createView(),
            'imageInfos' => $imageInfos,
            'menuInfos' => $menuInfos
        ]);
    }

    /**
     * @Route("/delete-page/{page}", name="delete_page", requirements={"page"="\d+"})
     */
    public function deletePageAction(Page $page): Response
    {
        $em = $this->doctrine->getManager();
        foreach($page->getImages() as $image) {
            unlink('img/' . $image->getName());
            $image->setPage(null);
            $em->remove($image);
        }
        $em->remove($page);

        $em->flush();

        return $this->redirectToRoute('modify');
    }

    /**
     * @Route("/delete-image/{image}", name="delete_image", requirements={"image"="\d+"})
     */
    public function deleteImageAction(Image $image): Response
    {
        $em = $this->doctrine->getManager();
        $page = $image->getPage()->getId();

        unlink('img/' . $image->getName());
        $em->remove($image);

        $em->flush();

        return $this->redirectToRoute('edit_page', ['page' => $page]);
    }

    public function menuAction(): array
    {
        return $this->doctrine->getRepository(Page::class)
            ->createQueryBuilder('p')
            ->select('p.name, p.position, p.id')
            ->orderBy('p.position', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
