<?php

namespace App\Controller\Api;

use App\Repository\AdRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api/search')]
class ApiSearchController extends AbstractController
{
    #[Route('/', name: '_search', methods: ['GET'])]
    public function search(Request $request, AdRepository $ads): JsonResponse
    {
        $query = $request->get('q', '');
        $limit = $request->get('l', 3);

        $foundAds = $ads->findBySearchQuery($query, $limit);

        $results = [];
        foreach ($foundAds as $ad) {
            $results[] = [
                'name' => htmlspecialchars($ad->getVehicle()->getName(), \ENT_COMPAT | \ENT_HTML5),
                'brand' => htmlspecialchars($ad->getVehicle()->getBrand(), \ENT_COMPAT | \ENT_HTML5),
            ];
        }

        return $this->json($results, Response::HTTP_OK, [], ['groups' => 'ad:read']);
    }
}