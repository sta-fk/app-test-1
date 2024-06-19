<?php

namespace App\Controller;

use App\Entity\Group;
use App\Form\GroupType;
use App\Repository\GroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(
    path: '/group',
    name: 'group_'
)]
class GroupController extends AbstractController
{
    #[Route(
        path: '/new',
        name: 'new',
        methods: ['GET', 'POST']
    )]
    public function new(
        Request $request,
        GroupRepository $repository,
    ): Response
    {
        $group = new Group();
        $form = $this->createForm(GroupType::class, $group);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $repository->save($group, true);

            return $this->redirectToRoute('group_list');
        }

        return $this->render('group/new.html.twig', [
            'user' => $group,
            'form' => $form,
        ]);
    }

    #[Route(
        path: '/list',
        name: 'list',
        methods: ['GET'])
    ]
    public function list(
        GroupRepository $repository,
    ): Response
    {
        return $this->render('group/list.html.twig', [
            'groups' => $repository->findAll()
        ]);
    }

    #[Route(
        path: '/{id}/edit',
        name: 'edit',
        requirements: ['group' => '\d+'],
        methods: ['GET', 'PUT', 'POST'])
    ]
    public function edit(
        Request $request,
        Group $group,
        GroupRepository $repository,
    ): Response
    {
        $form = $this->createForm(GroupType::class, $group);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $repository->save($group, true);

            return $this->redirectToRoute('group_list');
        }

        return $this->render('group/edit.html.twig', [
            'group' => $group,
            'form' => $form->createView(),
        ]);
    }

    #[Route(
        path: '/{id}/delete',
        name: 'delete',
        requirements: ['group' => '\d+'],
        methods: ['GET']
    )]
    public function delete(
        Group $group,
        GroupRepository $repository
    ): Response {
        $repository->remove($group, true);

        return $this->redirectToRoute('group_list');
    }
}