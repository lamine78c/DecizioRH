<?php

namespace App\Controller;

use App\Repository\VacationRequestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Vacation;
use App\Entity\VacationRequest;
use App\Form\VacationRequestType;
use App\Form\VacationRequestEditType;

class VacationRequestController extends AbstractController
{
    /**
     * @Route("/admin/vacation-request", name="vacation_request_index", methods={"GET"})
     */
    public function index(VacationRequestRepository $vacationRequestRepository): Response
    {
        return $this->render('vacationRequest/index.html.twig', [
            'vacationRequests' => $vacationRequestRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/vacation-request/new", name="vacation_request_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $vacationRequest = new VacationRequest();
        $form = $this->createForm(VacationRequestType::class, $vacationRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vacationRequest);
            $entityManager->flush();

            return $this->redirectToRoute('vacation_request_index');
        }

        return $this->render('vacationRequest/new.html.twig', [
            'vacationRequest' => $vacationRequest,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/vacation-request/{id}", name="vacation_request_show", methods={"GET"})
     */
    public function show(VacationRequest $vacationRequest): Response
    {
        return $this->render('vacationRequest/show.html.twig', [
            'vacationRequest' => $vacationRequest,
        ]);
    }

    /**
     * @Route("/admin/vacation-request/{id}/edit", name="vacation_request_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, VacationRequest $vacationRequest): Response
    {
        $form = $this->createForm(VacationRequestEditType::class, $vacationRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vacation_request_index');
        }

        $em = $this->getDoctrine()->getManager();

        $vacations= $em->getRepository(Vacation::class)->findBy(['user' => $vacationRequest->getUser()]);
        $vacationRequests = $em->getRepository(VacationRequest::class)->findBy(['user' => $vacationRequest->getUser()]);

        return $this->render('vacationRequest/edit.html.twig', [
            'vacationRequest' => $vacationRequest,
            'vacationRequests' => $vacationRequests,
            'vacations' => $vacations,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/vacation-request/{id}", name="vacation_request_delete", methods={"DELETE"})
     */
    public function delete(Request $request, VacationRequest $vacationRequest): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vacationRequest->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vacationRequest);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vacation_request_index');
    }
}
