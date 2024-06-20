<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\WebAdsAccount;
use App\Entity\WebAdsPartner;
use App\Form\UserType;
use App\Form\WebAdsAccountType;
use App\Module\WebAds\Service\Entity\AccountService;
use App\Repository\UserRepository;
use App\Repository\WebAdsAccountRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route(
        path: '/',
        name: 'index',
        methods: ['GET']
    )]
    public function index(): Response
    {
        return $this->render('app.html.twig');
    }
}