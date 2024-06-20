<?php

namespace App\Service;

use App\Entity\Group;
use Mpdf\Mpdf;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Twig\Environment;

class ReportGenerator
{
    private const REPORT_NAME = 'users-%s.pdf';

    public function __construct(
        private readonly Environment $twig,
    ){}

    public function generate(Group $group): StreamedResponse
    {
        $fileName = sprintf(self::REPORT_NAME, 'QA');

        $content = $this->twig->render('report/report.html.twig', [
            'group' => $group,
            'users' => $group->getUsers()
        ]);

        $response = new StreamedResponse(function () use ($content) {
            $mpdf = new Mpdf();
            $mpdf->WriteHTML($content);
            $mpdf->Output();
        });
        $response->headers->set('Content-Type', 'application/pdf');
        $response->headers->set('Content-Disposition', sprintf('attachment; filename="%s"', $fileName));
        $response->headers->set('X-Filename', $fileName);

        return $response;
    }
}