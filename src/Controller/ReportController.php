<?php

namespace App\Controller;

use App\Entity\Group;
use App\Service\ReportGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;

class ReportController extends AbstractController
{
    #[Route(
        path: '/group/{id}/report/download',
        name: 'report_generate',
        requirements: ['group' => '\d+'],
        methods: ['GET']
    )]
    public function generateReport(
        Group $group,
        ReportGenerator $generator,
    ): StreamedResponse|Response
    {
        return $generator->generate($group);
    }
}