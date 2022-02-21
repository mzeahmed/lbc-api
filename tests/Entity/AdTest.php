<?php

namespace App\Tests\Entity;

use App\Entity\Car;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AdTest extends KernelTestCase
{
    public function getEntity(): Car
    {
        return (new Car())
            ->setBrand('Renault')
            ->setModel(['Clio'])
        ;
    }

    public function assertHasError(Car $car, int $number = 0)
    {
        self::bootKernel();
        $error = static::getContainer()->get('validator')->validate($car);
        self::assertCount($number, $error);
    }

    /**
     * Test qu'il n'y a aucune aucune erreur au niveau de l'entité Ad
     *
     * @return void
     */
    public function testValidCarEntity()
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
    public function testInvalidBlankModelEntity()
    {
        $this->assertHasError($this->getEntity()->setModel([]), 1);
    }
}