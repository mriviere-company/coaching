<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Page;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends AbstractController
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }
    /**
     * @Route("/{_locale}", name="home", defaults={"_locale" = "fr"}, requirements={"_locale" = "fr|en|de"})
     */
    public function index(): Response
    {
        $imageInfos = $this->doctrine->getRepository(Image::class)
            ->createQueryBuilder('i')
            ->join('i.page', 'p')
            ->select('i.name, i.position')
            ->where('p.position = 0')
            ->orderBy('i.position', 'ASC')
            ->getQuery()
            ->getResult();

        $menuInfos = $this->menuAction();

        return $this->render('index.html.twig', [
            'imageInfos' => $imageInfos,
            'menuInfos' => $menuInfos
        ]);
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
