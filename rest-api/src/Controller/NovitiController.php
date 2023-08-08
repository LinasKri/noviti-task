<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Payment;

#[Route('/api', name: 'api_')]
class NovitiController extends AbstractController
{
    #[Route('/noviti', name: 'app_noviti', methods: ["POST"])]
    public function index(ManagerRegistry $doctrine, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $projectDir = $this->getParameter('kernel.project_dir');
        $filePath = $projectDir . '/src/Data/saved-loans.json';

        $dir = $projectDir . '/src/Data';
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        $loans = [];
        if (file_exists($filePath)) {
            $decodedLoans = json_decode(file_get_contents($filePath), true);
            if (is_array($decodedLoans)) {
                $loans = $decodedLoans;
            }
        }

        $loans[] = $data;
        file_put_contents($filePath, json_encode($loans));

        try {
            $entityManager = $doctrine->getManager();

            $payment = new Payment();

            $payment = new Payment();
            $payment->setLoanAmount($data['loan_amount']);
            $payment->setTermInMonths($data['term_in_months']);
            $payment->setRemainingAmount($data['remaining_amount']);
            $payment->setPrincipal($data['principal']);
            $payment->setInterest($data['interest']);
            $payment->setTotal($data['total']);

            $entityManager->persist($payment);
            $entityManager->flush();

            $data['id'] = $payment->getId();
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return $this->json(['error' => 'An error occurred while saving to the database.'], 500);
        }
    }
}
