<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\VacationRequest;
use App\Form\UserType;
use App\Form\UserVacationRequestType;
use App\Repository\RequestStatusRepository;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
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
    public function index(UserRepository $userRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $query  = $userRepository->queryAllUser();
        $users = $paginator->paginate(
            $query,
            $request->query->get('page', 1),
            10
        );

        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/user/profil", name="user_show", methods={"GET"})
     */
    public function show(): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $this->getUser(),
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
}
