<?php

namespace App\Controller\Api;

use App\Entity\Ad;
use App\Repository\AdRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;

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
        return $this->json($adRepository->findAll(), 200, [], ['groups' => 'ad:read']);
    }

    /**
     * @param Request                $request
     * @param SerializerInterface    $serializer
     * @param EntityManagerInterface $em
     * @param ValidatorInterface     $validator
     *
     * @return JsonResponse
     */
    #[Route('/store', name: '_new', methods: ['POST'])]
    public function store(
        Request $request,
        SerializerInterface $serializer,
        EntityManagerInterface $em,
        ValidatorInterface $validator
    ): JsonResponse {
        $receivedJson = $request->getContent();

        try {
            $ad = $serializer->deserialize($receivedJson, Ad::class, 'json');
            $ad->setCreatedAt(new \DateTime());

            $errors = $validator->validate($ad);
            if (count($errors) > 0) {
                return $this->json($errors, 400);
            }

            $em->persist($ad);
            $em->flush();

            return $this->json($ad, 201, [], ['groups' => 'ad:read']);
        } catch (NotEncodableValueException $e) {
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}
