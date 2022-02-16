<?php

namespace App\Controller\Api;

use App\Repository\AdRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api/ad', name: 'app_api_ad')]
class ApiAdController extends AbstractController
{
    /**
     * @param AdRepository $adRepository
     *
     * @return JsonResponse
     */
    #[Route('/', name: '_index', methods: ['GET'])]
    public function index(AdRepository $adRepository): JsonResponse
    {
        $ads = $adRepository->findAll();

        dd($ads);

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ApiController.php',
        ]);
    }

    /**
     * @return JsonResponse
     */
    #[Route('/add/new', name: '_new', methods: ['POST'])]
    public function add(): JsonResponse
    {
        return $this->json([

        ]);
    }
}
