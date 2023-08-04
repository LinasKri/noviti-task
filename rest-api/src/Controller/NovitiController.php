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
        $data = json_decode($request->getContent(), true);
        $data['id'] = uniqid();

        $projectDir = $this->getParameter('kernel.project_dir');
        $filePath = $projectDir . '/src/Data/saved-loans.json';

        $dir = $projectDir . '/src/Data';
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        $loans = [];
        if (file_exists($filePath)) {
            $loans = json_decode(file_get_contents($filePath), true);
            if (!is_array($loans)) {
                $loans = [];
            }
        }

        $loans[] = $data;

        // Write all loans back to the file
        file_put_contents($filePath, json_encode($loans));

        return $this->json([
            'message' => 'Loan saved!',
            'id' => $data['id'],
        ]);
    }
}
