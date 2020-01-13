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
use App\Entity\RequestStatus;
use App\Form\UserVacationRequestType;

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

            $this->addFlash('success', 'La demande a bien été mise à jour');
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

    /**
     * @Route("/user/vacation-request/list", name="user_vacation_request_list", methods={"GET"})
     */
    public function vacationRequestList(): Response
    {
        $vacationRequestRepository = $this->getDoctrine()
                ->getManager()
                ->getRepository(VacationRequest::class);

        $vacationRequests = $vacationRequestRepository->findBy(['user' => $this->getUser()], ['updatedAt' => 'ASC']);
        $vacationRequestsInProgress = [];
        $validatedVacationRequests = [];
        $rejectedVacationRequests = [];
        foreach ($vacationRequests as $vacationRequest) {
            if ($vacationRequest->getRequestStatus()->getName() === RequestStatus::STATUS_IN_PROGRESS) {
                $vacationRequestsInProgress[] = $vacationRequest;
            } elseif ($vacationRequest->getRequestStatus()->getName() === RequestStatus::STATUS_VALID) {
                 $validatedVacationRequests[] = $vacationRequest;
            } elseif ($vacationRequest->getRequestStatus()->getName() === RequestStatus::STATUS_REJECT) {
                 $rejectedVacationRequests[] = $vacationRequest;
            }
        }

        return $this->render('vacationRequest/user/vacation_request_list.html.twig', [
            'user' => $this->getUser(),
            'vacationRequestInProgress' => $vacationRequestsInProgress,
            'vacationRequestsValidated' => $validatedVacationRequests,
            'vacationRequestsRejected' => $rejectedVacationRequests,
        ]);
    }

    /**
     * @Route("/user/vacation-request/new", name="user_vacation_request_new", methods={"GET","POST"})
     */
    public function vacationRequestNew(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $vacationRequest = new VacationRequest();
        $form = $this->createForm(UserVacationRequestType::class, $vacationRequest);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $status = $entityManager->getRepository(RequestStatus::class)->findOneBy(['name' => RequestStatus::STATUS_IN_PROGRESS]);

            $vacationRequest->setUser($this->getUser());
            $vacationRequest->setRequestStatus($status);
            $entityManager->persist($vacationRequest);
            $entityManager->flush();

            $this->addFlash('success', "Votre demande d'absence a bien été prise en compte");

            return $this->redirectToRoute('user_vacation_request_list');
        }

        return $this->render('vacationRequest/user/vacation_request_new_or_edit_form.html.twig', [
            'vacationRequest' => $vacationRequest,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/vacation-request/{id}/edit", name="user_vacation_request_edit", methods={"GET","POST"})
     */
    public function vacationRequestEdit(Request $request, VacationRequest $vacationRequest): Response
    {
        $form = $this->createForm(UserVacationRequestType::class, $vacationRequest);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', "Votre demande d'absence a bien été modifiée");

            return $this->redirectToRoute('user_vacation_request_list');
        }

        return $this->render('vacationRequest/user/vacation_request_new_or_edit_form.html.twig', [
            'vacationRequest' => $vacationRequest,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/vacation-request/{id}", name="user_vacation_request_delete", methods={"DELETE"})
     */
    public function vacationRequestDelete(Request $request, VacationRequest $vacationRequest): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vacationRequest->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vacationRequest);
            $entityManager->flush();
        }

         $this->addFlash('success', "La demande d'absence a bien été supprimée");

        return $this->redirectToRoute('user_vacation_request_list');
    }
}
