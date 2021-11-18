<?php

namespace App\Controller;

use App\Entity\Recit;
use App\Form\RecitType;
use App\Repository\RecitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/recit")
 */
class RecitController extends AbstractController
{
    /**
     * @Route("/", name="recit_index", methods={"GET"})
     */
    public function index(RecitRepository $recitRepository): Response
    {
        return $this->render('recit/index.html.twig', [
            'recits' => $recitRepository->findAll(),
        ]);
    }



    /**
     * @Route("/{id}", name="recit_show", methods={"GET"})
     */
    public function show(Recit $recit): Response
    {
        $views = $recit->getViews();
        $views = $views +1;
        $recit->setViews($views);

        $entitymanager = $this->getDoctrine()->getManager();
        $entitymanager->persist($recit);
        $entitymanager->flush();

        return $this->render('recit/show.html.twig', [
            'recit' => $recit,
        ]);
    }




}
