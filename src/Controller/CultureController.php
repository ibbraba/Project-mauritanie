<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Repository\ArticleRepository;
use App\Repository\RecitRepository;
use App\Repository\TagRepository;
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
    public function cuisine(TagRepository $tagRepository): Response
    {
        $tagName = "Cuisine";
        $tag = $tagRepository->findOneBy([
            'name' => $tagName
        ]);
        $recits = $tag->getRecits();

        $articles = $tag->getArticles();



        return $this->render('culture/cuisine.html.twig', [
            'controller_name' => 'CultureController',
            'recits' => $recits,
            'articles' =>$articles,
            'tagName' => $tagName
        ]);
    }


    /**
     * @Route("/litterature", name="litterature")
     */
    public function literrature(TagRepository $tagRepository): Response
    {
        $tagName = "Litterature";
        $tag = $tagRepository->findOneBy([
            'name' => $tagName
        ]);
        $recits = $tag->getRecits();

        $articles = $tag->getArticles();



        return $this->render('culture/litterature.html.twig', [
            'controller_name' => 'CultureController',
            'recits' => $recits,
            'articles' =>$articles,
            'tagName' => $tagName
        ]);
    }


    /**
     * @Route("/musique", name="musique")
     */
    public function musique(TagRepository $tagRepository): Response
    {
        $tagName = "Musique";
        $tag = $tagRepository->findOneBy([
            'name' => $tagName
        ]);
        $recits = $tag->getRecits();

        $articles = $tag->getArticles();


        return $this->render('culture/musique.html.twig', [
            'controller_name' => 'CultureController',
            'recits' => $recits,
            'articles' =>$articles,
            'tagName' => $tagName
        ]);
    }


    /**
     * @Route("/tourisme", name="tourisme")
     */
    public function tourisme(TagRepository $tagRepository): Response
    {

        $tagName = "Tourisme";
        $tag = $tagRepository->findOneBy([
            'name' => $tagName
        ]);
        $recits = $tag->getRecits();

        $articles = $tag->getArticles();

        return $this->render('culture/tourisme.html.twig', [
            'controller_name' => 'CultureController',
            'recits' => $recits,
            'articles' =>$articles,
            'tagName' => $tagName
        ]);
    }

}
