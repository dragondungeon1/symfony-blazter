<?php

namespace App\Controller;

use App\Entity\Les;
use App\Form\LesType;
use App\Repository\LesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/les")
 */
class LesController extends AbstractController
{
    /**
     * @Route("/", name="les_index", methods={"GET"})
     */
    public function index(LesRepository $lesRepository): Response
    {
        return $this->render('les/index.html.twig', [
            'les' => $lesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="les_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $le = new Les();
        $form = $this->createForm(LesType::class, $le);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($le);
            $entityManager->flush();

            return $this->redirectToRoute('les_index');
        }

        return $this->render('les/new.html.twig', [
            'le' => $le,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="les_show", methods={"GET"})
     */
    public function show(Les $le): Response
    {
        return $this->render('les/show.html.twig', [
            'le' => $le,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="les_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Les $le): Response
    {
        $form = $this->createForm(LesType::class, $le);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('les_index');
        }

        return $this->render('les/edit.html.twig', [
            'le' => $le,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="les_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Les $le): Response
    {
        if ($this->isCsrfTokenValid('delete'.$le->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($le);
            $entityManager->flush();
        }

        return $this->redirectToRoute('les_index');
    }
}
