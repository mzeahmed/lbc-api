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
        $json = $request->getContent();

        try {
            $ad = $serializer->deserialize($json, Ad::class, 'json');
            $ad->setCreatedAt(new \DateTime());

            $errors = $validator->validate($ad);
            if (count($errors) > 0) {
                return $this->json($errors, Response::HTTP_BAD_REQUEST,);
            }

            $em->persist($ad);
            $em->flush();

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
     * @param Ad                     $ad
     * @param Request                $request
     * @param SerializerInterface    $serializer
     * @param ValidatorInterface     $validator
     * @param EntityManagerInterface $manager
     *
     * @return JsonResponse
     */
    #[Route('/{id}/edit', name: '_edit', methods: ['PUT'])]
    public function update(
        Ad $ad,
        Request $request,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        EntityManagerInterface $manager
    ): JsonResponse {
        $json = $request->getContent();

        try {
            $class = $serializer->deserialize($json, Ad::class, 'json');

            $errors = $validator->validate($class);
            if (count($errors) > 0) {
                return $this->json($errors, Response::HTTP_BAD_REQUEST);
            }

            $manager->persist($ad);
            $manager->flush();

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
     * @param Ad                     $ad
     * @param EntityManagerInterface $manager
     *
     * @return JsonResponse
     */
    #[Route('/{id}/delete', name: '_delete', methods: ['POST'])]
    public function delete(Ad $ad, EntityManagerInterface $manager): JsonResponse
    {
        try {
            $manager->remove($ad);
            $manager->flush();

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
