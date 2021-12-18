<?php

namespace App\Controller;

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
     * @Route("/cuisine", name="culture")
     */
    public function cuisine(): Response
    {



        return $this->render('cuisine/index.html.twig', [
            'controller_name' => 'CultureController',
        ]);
    }


    /**
     * @Route("/litterature", name="culture")
     */
    public function literrature(): Response
    {



        return $this->render('litterature/index.html.twig', [
            'controller_name' => 'CultureController',
        ]);
    }


    /**
     * @Route("/musique", name="culture")
     */
    public function musique(): Response
    {



        return $this->render('musique/index.html.twig', [
            'controller_name' => 'CultureController',
        ]);
    }


    /**
     * @Route("/tourisme", name="culture")
     */
    public function tourisme(): Response
    {



        return $this->render('tourisme/index.html.twig', [
            'controller_name' => 'CultureController',
        ]);
    }

}
