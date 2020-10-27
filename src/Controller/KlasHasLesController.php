<?php

namespace App\Controller;

use App\Entity\KlasHasLes;
use App\Form\KlasHasLesType;
use App\Repository\KlasHasLesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/klas/has/les")
 */
class KlasHasLesController extends AbstractController
{
    /**
     * @Route("/", name="klas_has_les_index", methods={"GET"})
     */
    public function index(KlasHasLesRepository $klasHasLesRepository): Response
    {
        return $this->render('klas_has_les/index.html.twig', [
            'klas_has_les' => $klasHasLesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="klas_has_les_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $klasHasLe = new KlasHasLes();
        $form = $this->createForm(KlasHasLesType::class, $klasHasLe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($klasHasLe);
            $entityManager->flush();

            return $this->redirectToRoute('klas_has_les_index');
        }

        return $this->render('klas_has_les/new.html.twig', [
            'klas_has_le' => $klasHasLe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="klas_has_les_show", methods={"GET"})
     */
    public function show(KlasHasLes $klasHasLe): Response
    {
        return $this->render('klas_has_les/show.html.twig', [
            'klas_has_le' => $klasHasLe,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="klas_has_les_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, KlasHasLes $klasHasLe): Response
    {
        $form = $this->createForm(KlasHasLesType::class, $klasHasLe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('klas_has_les_index');
        }

        return $this->render('klas_has_les/edit.html.twig', [
            'klas_has_le' => $klasHasLe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="klas_has_les_delete", methods={"DELETE"})
     */
    public function delete(Request $request, KlasHasLes $klasHasLe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$klasHasLe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($klasHasLe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('klas_has_les_index');
    }
}
