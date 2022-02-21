<?php

namespace App\Tests\Entity;

use App\Entity\Ad;
use App\Entity\Automotive;
use App\Repository\CategoryRepository;
use App\Repository\AutomotiveRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AdTest extends KernelTestCase
{
    public function getEntity(): Ad
    {
        $autoRepo = $this->createMock(AutomotiveRepository::class);
        $cateRepo = $this->createMock(CategoryRepository::class);

        $vehicle = $autoRepo->findBy(['id' => 2]);
        $category = $cateRepo->findBy(['id' => 2]);

        return (new Ad())
            ->setTitle('test')
            ->setContent('contenu')
            ->setVehicle(($vehicle[0]))
            ->setCategory($category[0])
        ;
    }

    public function assertHasError(Automotive $automotive, int $number = 0)
    {
        self::bootKernel();
        $error = static::getContainer()->get('validator')->validate($automotive);
        self::assertCount($number, $error);
    }

    /**
     * Test qu'il n'y a aucune aucune erreur au niveau de l'entité Ad
     *
     * @return void
     */
    public function testValidAutomotiveEntity()
    {
        $this->assertHasError($this->getEntity(), 0);
    }

    /**
     * Simuler une erreur à la propriété brand pour rendre le test valide
     *
     * @return void
     */
    public function testInvalidBlankBrandEntity()
    {
        $this->assertHasError($this->getEntity()->setBrand(''), 1);
    }

    /**
     * Simuler une erreur à la propriété model pour rendre le test valide
     *
     * @return void
     */
    public function testInvalidBlankNameEntity()
    {
        $this->assertHasError($this->getEntity()->setName(''), 1);
    }
}