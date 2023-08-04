<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class NovitiController extends AbstractController
{
    #[Route('/noviti', name: 'app_noviti', methods: ["POST"])]
    public function index(Request $request): JsonResponse
    {
        $data = $request->getContent();
        $projectDir = $this->getParameter('kernel.project_dir');
        $dir = $projectDir . '/src/Data';
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        file_put_contents($dir . '/saved-loans.json', $data);

        return $this->json([
            'message' => 'Loan saved!',
        ]);
    }
}
