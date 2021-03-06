<?php

namespace App\Controller;

use App\Entity\MotCle;
use App\Form\MotCleType;
use App\Repository\MotCleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/motcle")
 */
class MotCleController extends AbstractController
{
    /**
     * @Route("/", name="mot_cle_index", methods={"GET"})
     */
    public function index(MotCleRepository $motCleRepository): Response
    {
        return $this->render('mot_cle/index.html.twig', [
            'mot_cles' => $motCleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="mot_cle_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $motCle = new MotCle();
        $form = $this->createForm(MotCleType::class, $motCle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($motCle);
            $entityManager->flush();

            return $this->redirectToRoute('mot_cle_index');
        }

        return $this->render('mot_cle/new.html.twig', [
            'mot_cle' => $motCle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mot_cle_show", methods={"GET"})
     */
    public function show(MotCle $motCle): Response
    {
        return $this->render('mot_cle/show.html.twig', [
            'mot_cle' => $motCle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="mot_cle_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MotCle $motCle): Response
    {
        $form = $this->createForm(MotCleType::class, $motCle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mot_cle_index');
        }

        return $this->render('mot_cle/edit.html.twig', [
            'mot_cle' => $motCle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mot_cle_delete", methods={"POST"})
     */
    public function delete(Request $request, MotCle $motCle): Response
    {
        if ($this->isCsrfTokenValid('delete' . $motCle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($motCle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mot_cle_index');
    }
}
