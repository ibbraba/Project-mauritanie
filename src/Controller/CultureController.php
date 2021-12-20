<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\RecitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Here we'll make all pages related to the cultutre-box feature
 * @Route ("/culture")
 *
 */

class CultureController extends AbstractController
{
    /**
     * @Route("/cuisine", name="cuisine")
     */
    public function cuisine(ArticleRepository $articleRepository, RecitRepository $recitRepository): Response
    {
        $tag = "Cuisine";

        $recitsTag = $recitRepository->findAllByTag($tag);
        $articlesTag = $articleRepository->findAllByTag($tag);

        dd($recitsTag, $articlesTag);


        return $this->render('culture/cuisine.html.twig', [
            'controller_name' => 'CultureController',
        ]);
    }


    /**
     * @Route("/litterature", name="culture")
     */
    public function literrature(): Response
    {



        return $this->render('culture/litterature.html.twig', [
            'controller_name' => 'CultureController',
        ]);
    }


    /**
     * @Route("/musique", name="culture")
     */
    public function musique(): Response
    {



        return $this->render('culture/musique.html.twig', [
            'controller_name' => 'CultureController',
        ]);
    }


    /**
     * @Route("/tourisme", name="culture")
     */
    public function tourisme(): Response
    {



        return $this->render('culture/tourisme.html.twig', [
            'controller_name' => 'CultureController',
        ]);
    }

}
