<?php

namespace App\Controller;

use App\Entity\Vacation;
use App\Form\VacationFormType;
use App\Repository\VacationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\VacationRequest;

class VacationController extends AbstractController
{
    /**
     * @Route("/admin/vacation", name="vacation_index", methods={"GET"})
     */
    public function index(VacationRepository $vacationRepository): Response
    {
        return $this->render('vacation/index.html.twig', [
            'vacations' => $vacationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/vacation/new", name="vacation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $vacation = new Vacation();
        $form = $this->createForm(VacationFormType::class, $vacation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vacation);
            $entityManager->flush();

            return $this->redirectToRoute('vacation_index');
        }

        return $this->render('vacation/new.html.twig', [
            'vacation' => $vacation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/vacation/{id}", name="vacation_show", methods={"GET"})
     */
    public function show(Vacation $vacation): Response
    {
        $em = $this->getDoctrine()->getManager();

        $vacationRequests = $em->getRepository(VacationRequest::class)->findBy(['user' => $vacation->getUser()]);

        return $this->render('vacation/show.html.twig', [
            'vacation' => $vacation,
            'vacationRequests' => $vacationRequests,
        ]);
    }

    /**
     * @Route("/admin/vacation/{id}/edit", name="vacation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Vacation $vacation): Response
    {
        $form = $this->createForm(VacationFormType::class, $vacation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vacation_index');
        }

        return $this->render('vacation/edit.html.twig', [
            'vacation' => $vacation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/vacation/{id}", name="vacation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Vacation $vacation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vacation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vacation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vacation_index');
    }
}
