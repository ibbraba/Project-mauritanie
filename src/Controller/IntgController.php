<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Recit;
use App\Entity\Tag;
use App\Entity\Ville;
use App\Form\ArticleType;
use App\Form\RecitType;
use App\Form\TagType;
use App\Form\VilleType;
use App\Repository\ArticleRepository;
use App\Repository\RecitRepository;
use App\Repository\TagRepository;
use App\Repository\VilleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
  * @Route ("/intgestion")
  * Require ROLE_ADMIN for *every* controller method in this class.
  * @IsGranted("ROLE_ADMIN")
  */

class IntgController extends AbstractController
{
    /**
     * @Route("/main", name="intg")
     */
    public function index(TagRepository $tagRepository, Request $request): Response
    {
        $tags = $tagRepository->findAll();

        //Formulaire ajout Tag
        $tag = new Tag();
        $formTag= $this->createForm(TagType::class, $tag);
        $formTag->handleRequest($request);
        if($formTag->isSubmitted() && $formTag->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush();
            $this->addFlash("success", " Tag ajouté ! ");
            return $this->redirectToRoute('intg', [], Response::HTTP_SEE_OTHER);

        }



        return $this->render('intg/index.html.twig', [
            'controller_name' => 'IntgController',
            'tags' => $tags,
            'formTag' => $formTag->createView()

        ]);
    }


    /**
     * @Route ("/articlelist", name="intg_article")
     */
    public function intg_article(ArticleRepository $articleRepository){
        $articleList= $articleRepository->findAll();

        return $this->render('intg/intg_articles.html.twig', [
            'articleList' => $articleList,
        ]);
    }

    /**
     * @Route ("/recitLitst", name="intg_recit")
     */
    public function intg_recit(RecitRepository $recitRepository){
        $recitList = $recitRepository->findAll();

        return $this->render('intg/intg_recits.html.twig', [
            'recitList' => $recitList,
        ]);

    }


    /**
     * @Route("recit/new", name="recit_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $recit = new Recit();
        $form = $this->createForm(RecitType::class, $recit);
        $recit->setDate(new \DateTime(("now")));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($recit);
            $entityManager->flush();
            $this->addFlash("success", "Votre récit a bien été créée !");
            return $this->redirectToRoute('intg', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('recit/new.html.twig', [
            'recit' => $recit,
            'form' => $form,
        ]);
    }

    /**
     * @Route("article/new", name="article_new", methods={"GET","POST"})
     */
    public function newarticle(Request $request): Response
    {
        $article = new Article();
        $article->setDate(new \DateTime(("now")));
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();
            $this->addFlash("success", "Votre article a bien été créée ! ");
            return $this->redirectToRoute('intg', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article/new.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }



    /**
     * @Route("recit/{id}", name="recit_delete", methods={"POST"})
     */
    public function delete(Request $request, Recit $recit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recit->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($recit);
            $entityManager->flush();
            $this->addFlash('success', 'Récit supprimé !');
        }

        return $this->redirectToRoute('intg', [], Response::HTTP_SEE_OTHER);
    }








    /**
     * @Route("recit/{id}/edit", name="recit_edit", methods={"GET","POST"})
     */
    public function editrecit(Request $request, Recit $recit): Response
    {
        $form = $this->createForm(RecitType::class, $recit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success" , "Récit modifié !");

            return $this->redirectToRoute('intg', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('recit/edit.html.twig', [
            'recit' => $recit,
            'form' => $form,
        ]);
    }




    /**
     * @Route("article/{id}/edit", name="article_edit", methods={"GET","POST"})
     */
    public function editarticle(Request $request, Article $article): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash("success","Article modifié !");
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('intg', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article/edit.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

    /**
     * @Route("article/{id}", name="article_delete", methods={"POST"})
     */
    public function deletearticle(Request $request, Article $article): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();
            $this->addFlash('success', 'Article supprimé !');
        }

        return $this->redirectToRoute('intg', [], Response::HTTP_SEE_OTHER);
    }


    /**
     * @Route ("/cities", name="cities")
     */
    public function cities (Request $request, VilleRepository $villeRepository){

        $citiesList = $villeRepository->findAll();

        $city = new Ville();
        $form = $this->createForm(VilleType::class, $city);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($city);
            $entityManager->flush();
            $this->addFlash("success","Ville ajoutée");
        }


        $this->redirectToRoute("cities", [], Response::HTTP_SEE_OTHER );


        return $this->renderForm('intg/cities.html.twig', [
            'citiesList' => $citiesList,
            'form' => $form
        ]);
    }

    /**
     * @Route ("/cities/{id}/show", name="city_show")
     */
    public function city_show(Ville $ville){

        return $this->render('intg/city_show.html.twig', [
            'city' => $ville,
        ]);

    }

}


