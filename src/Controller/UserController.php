<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\VacationRequest;
use App\Form\UserType;
use App\Form\UserVacationRequestType;
use App\Repository\RequestStatusRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Annotation\Route;


class UserController extends AbstractController
{
    /**
     * @Route("/admin/user/list", name="user_index", methods={"GET"})
     *  @Security("has_role('ROLE_ADMIN')")
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/user/{id}/profil", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/user/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_show', ['id' => $user->getId()]);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }

    /**
     * @Route("/user/{id}/vacation-request/list", name="user_vacation_request_list", methods={"GET"})
     */
    public function vacationRequestList(User $user): Response
    {
        return $this->render('vacationRequest/user/vacation_request_list.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/user/{id}/vacation/list", name="user_vacation_list", methods={"GET"})
     */
    public function vacationList(User $user): Response
    {
        return $this->render('vacationRequest/user/vacation_list.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/user/{id}/vacation-request/new", name="user_vacation_request_new", methods={"GET","POST"})
     */
    public function new(Request $request, User $user, RequestStatusRepository $requestStatusRepository): Response
    {
        $vacationRequest = new VacationRequest();
        $form = $this->createForm(UserVacationRequestType::class, $vacationRequest);
        $form->handleRequest($request);

        $status = $requestStatusRepository->findOneBy(['name' => 'En Cours']);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $vacationRequest->setUser($user);
            $vacationRequest->setRequestStatus($status);
            $entityManager->persist($vacationRequest);
            $entityManager->flush();

            return $this->redirectToRoute('user_vacation_request_list', ['id' => $user->getId()]);
        }

        return $this->render('vacationRequest/user/vacation_request_new_or_edit_form.html.twig', [
            'vacationRequest' => $vacationRequest,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/{id}/vacation-request/edit", name="user_vacation_request_edit", methods={"GET","POST"})
     */
    public function vacationRequestEdit(Request $request, VacationRequest $vacationRequest): Response
    {
        $form = $this->createForm(UserVacationRequestType::class, $vacationRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_vacation_request_list', ['id' => $vacationRequest->getUser()->getId()]);
        }

        return $this->render('vacationRequest/user/vacation_request_new_or_edit_form.html.twig', [
            'vacationRequest' => $vacationRequest,
            'form' => $form->createView(),
        ]);
    }
}
