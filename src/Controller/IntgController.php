<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Recit;
use App\Form\ArticleType;
use App\Form\RecitType;
use App\Repository\ArticleRepository;
use App\Repository\RecitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
    public function index(ArticleRepository $articleRepository, RecitRepository $recitRepository): Response
    {
        $list = $articleRepository->findAll();
        $recits = $recitRepository->findAll();


        return $this->render('intg/index.html.twig', [
            'controller_name' => 'IntgController',
            'list' => $list,
            'recits' => $recits

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






}


