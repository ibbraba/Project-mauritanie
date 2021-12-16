<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\RecitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(ArticleRepository $articleRepository, RecitRepository $recitRepository): Response
    {
        //widget Dateheure et Meteo Mauritanie

        //Onglet Articles
        $articles = $articleRepository->findIndexArticles();

        $recits = $recitRepository->findIndexRecits();


        //Media query YT


        //Partenaires


        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'articles' => $articles,
            'recits' => $recits
        ]);
    }

    /**
     * @Route("/articles", name="article")
     */
    public function article(ArticleRepository $articleRepository): Response
    {
        /* TODO Design page */
       $list = $articleRepository->findAll();

        return $this->render('main/article.html.twig', [
            'controller_name' => 'MainController',
            'list'=> $list
        ]);
    }


    /**
     * @Route("/decouverte", name="discover")
     */
    public function discover(): Response
    {


        //Page unique avec React
        // Media Query videos YouTube...
        /* TODO Design page */

        return $this->render('main/discover.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }



    /**
     * @Route("/recits", name="recits")
     */
    public function Recits(RecitRepository $recitRepository): Response
    {
        //Paragraphe intro
        // Découvrez les récits de nos proches mauritanniens
        // Envie de partager un récit sur la Mauritanie?
        /* TODO Design page */


        $list = $recitRepository->findAll();

        return $this->render('main/recits.html.twig', [
            'controller_name' => 'MainController',
            'list'=>$list
        ]);



    }

    /**
     * @Route("/culture", name="culture")
     */
    public function culture(): Response
    {
        //Paragraphe intro
        //Articles sur la culture
        /* TODO Design page */

        return $this->render('main/culture.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route ("/portfolio", name="portfolio")
     *
     */
    /* TODO create portfolio */
    public function portfolio():Response {
        return $this->render('main/culture.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }



}
