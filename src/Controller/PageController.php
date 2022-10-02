<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Page;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class TopMenuController
 * @package App\Controller
 */
class PageController extends AbstractController
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @Route("/p1/{page}", name="first", requirements={"page"="\.*[a-zA-Z]+.*"})
     */
    public function presentationAction(): Response
    {
        $imageInfos = $this->getImageInfos(1);
        $menuInfos = $this->menuAction();

        return $this->render('page/page_webp.html.twig', [
            'imageInfos' => $imageInfos,
            'menuInfos' => $menuInfos
        ]);
    }

    /**
     * @Route("/p2/{page}", name="second", requirements={"page"="\.*[a-zA-Z]+.*"})
     */
    public function secondAction(): Response
    {
        $imageInfos = $this->getImageInfos(2);
        $menuInfos = $this->menuAction();

        return $this->render('page/page_webp.html.twig', [
            'imageInfos' => $imageInfos,
            'menuInfos' => $menuInfos
        ]);
    }

    /**
     * @Route("/p3/{page}", name="third", requirements={"page"="\.*[a-zA-Z]+.*"})
     */
    public function thirdAction(): Response
    {
        $imageInfos = $this->getImageInfos(3);
        $menuInfos = $this->menuAction();

        return $this->render('page/page_webp.html.twig', [
            'imageInfos' => $imageInfos,
            'menuInfos' => $menuInfos
        ]);
    }

    /**
     * @Route("/p4/{page}", name="fourth", requirements={"page"="\.*[a-zA-Z]+.*"})
     */
    public function fourthAction(): Response
    {
        $imageInfos = $this->getImageInfos(4);
        $menuInfos = $this->menuAction();

        return $this->render('page/page_webp.html.twig', [
            'imageInfos' => $imageInfos,
            'menuInfos' => $menuInfos
        ]);
    }

    /**
     * @Route("/p5/{page}", name="fifth", requirements={"page"="\.*[a-zA-Z]+.*"})
     */
    public function fifthAction(): Response
    {
        $imageInfos = $this->getImageInfos(5);
        $menuInfos = $this->menuAction();

        return $this->render('page/page_webp.html.twig', [
            'imageInfos' => $imageInfos,
            'menuInfos' => $menuInfos
        ]);
    }

    /**
     * @Route("/p6/{page}", name="sixth", requirements={"page"="\.*[a-zA-Z]+.*"})
     */
    public function sixthAction(): Response
    {
        $imageInfos = $this->getImageInfos(6);
        $menuInfos = $this->menuAction();

        return $this->render('page/page_webp.html.twig', [
            'imageInfos' => $imageInfos,
            'menuInfos' => $menuInfos
        ]);
    }

    /**
     * @Route("/p7/{page}", name="seventh", requirements={"page"="\.*[a-zA-Z]+.*"})
     */
    public function seventhAction(): Response
    {
        $imageInfos = $this->getImageInfos(7);
        $menuInfos = $this->menuAction();

        return $this->render('page/page_webp.html.twig', [
            'imageInfos' => $imageInfos,
            'menuInfos' => $menuInfos
        ]);
    }

    /**
     * @Route("/p8/{page}", name="eighth", requirements={"page"="\.*[a-zA-Z]+.*"})
     */
    public function eighthAction(): Response
    {
        $imageInfos = $this->getImageInfos(8);
        $menuInfos = $this->menuAction();

        return $this->render('page/page_webp.html.twig', [
            'imageInfos' => $imageInfos,
            'menuInfos' => $menuInfos
        ]);
    }

    /**
     * @Route("/p9/{page}", name="ninth", requirements={"page"="\.*[a-zA-Z]+.*"})
     */
    public function ninthAction(): Response
    {
        $imageInfos = $this->getImageInfos(9);
        $menuInfos = $this->menuAction();

        return $this->render('page/page_webp.html.twig', [
            'imageInfos' => $imageInfos,
            'menuInfos' => $menuInfos
        ]);
    }

    /**
     * @Route("/p10/{page}", name="tenth", requirements={"page"="\.*[a-zA-Z]+.*"})
     */
    public function tenthAction(): Response
    {
        $imageInfos = $this->getImageInfos(10);
        $menuInfos = $this->menuAction();

        return $this->render('page/page_webp.html.twig', [
            'imageInfos' => $imageInfos,
            'menuInfos' => $menuInfos
        ]);
    }

    public function getImageInfos($position): array
    {
        return $this->doctrine->getRepository(Image::class)
                ->createQueryBuilder('i')
                ->join('i.page', 'p')
                ->select('i.name, i.position')
                ->where('p.position =:position')
                ->setParameters(['position' => $position])
                ->orderBy('i.position', 'ASC')
                ->getQuery()
                ->getResult();
    }

    public function menuAction(): array
    {
        return $this->doctrine->getRepository(Page::class)
            ->createQueryBuilder('p')
            ->select('p.name, p.position')
            ->orderBy('p.position', 'ASC')
            ->where('p.position != 0')
            ->getQuery()
            ->getResult();
    }
}
