<?php

namespace App\Controller\Api;

use App\Entity\Ad;
use App\Repository\AdRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;

#[Route('/api/ad', name: 'app_api_ad')]
class ApiAdController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
        private SerializerInterface $serializer,
        private ValidatorInterface $validator
    ) {
    }

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
     * @param Request $request
     *
     * @return JsonResponse
     */
    #[Route('/store', name: '_new', methods: ['POST'])]
    public function store(Request $request): JsonResponse
    {
        $json = $request->getContent();

        try {
            $ad = $this->serializer->deserialize($json, Ad::class, 'json');
            $ad->setCreatedAt(new \DateTime());

            $errors = $this->validator->validate($ad);
            if (count($errors) > 0) {
                return $this->json($errors, Response::HTTP_BAD_REQUEST,);
            }

            $this->em->persist($ad);
            $this->em->flush();

            return $this->json($ad, 201, [], ['groups' => 'ad:read']);
        } catch (NotEncodableValueException $e) {
            return $this->json([
                'status' => Response::HTTP_BAD_REQUEST,
                'message' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param Ad $ad
     *
     * @return JsonResponse
     */
    #[Route('/{id}', name: '_read', methods: ['GET'])]
    public function read(Ad $ad): JsonResponse
    {
        return $this->json($ad, Response::HTTP_OK, [], ['groups' => 'ad:read']);
    }

    /**
     * @param Ad      $ad
     * @param Request $request
     *
     * @return JsonResponse
     */
    #[Route('/{id}/edit', name: '_edit', methods: ['PUT'])]
    public function update(Ad $ad, Request $request): JsonResponse
    {
        $json = $request->getContent();

        try {
            $class = $this->serializer->deserialize($json, Ad::class, 'json');

            $errors = $this->validator->validate($class);
            if (count($errors) > 0) {
                return $this->json($errors, Response::HTTP_BAD_REQUEST);
            }

            $this->em->persist($ad);
            $this->em->flush();

            return $this->json([
                'code' => 'update',
                'message' => 'Ad is successfully updated',
            ], Response::HTTP_OK);
        } catch (NotEncodableValueException $e) {
            return $this->json([
                'status' => Response::HTTP_BAD_REQUEST,
                'message' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param Ad $ad
     *
     * @return JsonResponse
     */
    #[Route('/{id}/delete', name: '_delete', methods: ['POST'])]
    public function delete(Ad $ad): JsonResponse
    {
        try {
            $this->em->remove($ad);
            $this->em->flush();

            return $this->json([
                'code' => 'remove',
                'message' => 'Ad ' . $ad->getTitle() . 'is successfully deleted',
            ], Response::HTTP_OK);
        } catch (NotFoundHttpException $e) {
            return $this->json([
                'status' => Response::HTTP_BAD_REQUEST,
                'message' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
