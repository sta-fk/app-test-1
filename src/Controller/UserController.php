<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(
    path: '/user',
    name: 'user_'
)]
class UserController extends AbstractController
{
    #[Route(
        path: '/new',
        name: 'new',
        requirements: ['user' => '\d+'],
        methods: ['GET', 'POST']
    )]
    public function new(
        Request $request,
        UserRepository $repository,
    ): Response {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $repository->save($user, true);

            return $this->redirectToRoute('user_list');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/list', name: 'list', methods: ['GET'])]
    public function list(
        UserRepository $repository
    ): Response
    {
        return $this->render('user/list.html.twig', [
            'users' => $repository->findAll()
        ]);
    }

    #[Route(
        path: '/{id}/edit',
        name: 'edit',
        requirements: ['user' => '\d+'],
        methods: ['GET', 'PUT', 'POST']
    )]
    public function edit(
        Request $request,
        User $user,
        UserRepository $repository,
    ): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $repository->save($user, true);

            return $this->redirectToRoute('user_list');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    #[Route(
        path: '/{id}/delete',
        name: 'delete',
        requirements: ['user' => '\d+'],
        methods: ['GET']
    )]
    public function delete(
        User $user,
        UserRepository $repository
    ): Response {
        $repository->remove($user, true);

        return $this->redirectToRoute('user_list');
    }
}