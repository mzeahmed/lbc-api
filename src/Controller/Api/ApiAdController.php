<?php

namespace App\Controller\Api;

use App\Entity\Ad;
use App\Entity\Category;
use App\Entity\Automotive;
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

    #[Route('/', name: '_index', methods: ['GET'])]
    public function index(AdRepository $adRepository): JsonResponse
    {
        return $this->json($adRepository->findAll(), 200, [], ['groups' => 'ad:read']);
    }

    #[Route('/store', name: '_new', methods: ['POST'])]
    public function store(Request $request): JsonResponse
    {
        $json = $request->getContent();
        $obj = json_decode($json);
        $vehicleId = $obj->{'vehicle'}->{'id'};
        $categoryId = $obj->{'category'}->{'id'};

        $automotive = $this->em->getRepository(Automotive::class)->findBy(['id' => $vehicleId]);
        $category = $this->em->getRepository(Category::class)->findBy(['id' => $categoryId]);

        try {
            $ad = $this->serializer->deserialize($json, Ad::class, 'json');

            $ad
                ->setCreatedAt(new \DateTime())
                ->setVehicle($automotive[0])
                ->setCategory($category[0])
            ;

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

    #[Route('/{id}', name: '_read', methods: ['GET'])]
    public function read(Ad $ad): JsonResponse
    {
        return $this->json($ad, Response::HTTP_OK, [], ['groups' => 'ad:read']);
    }

    #[Route('/{id}/edit', name: '_edit', methods: ['PATCH'])]
    public function update(Request $request, AdRepository $adRepo): JsonResponse
    {
        $json = $request->getContent();
        $obj = json_decode($json);
        $objId = $obj->{'id'};
        $oldAd = $adRepo->find($objId);

        try {
            $entity = $this->serializer->deserialize($json, Ad::class, 'json', ['object_to_populate' => $oldAd]);

            $errors = $this->validator->validate($entity);
            if (count($errors) > 0) {
                return $this->json($errors, Response::HTTP_BAD_REQUEST);
            }

            $this->em->persist($entity);
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

    #[Route('/{id}/delete', name: '_delete', methods: ['DELETE'])]
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
