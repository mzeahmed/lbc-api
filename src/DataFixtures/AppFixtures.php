<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Ad;
use App\Entity\Car;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    private \Faker\Generator $faker;

    private array $audi;

    private array $bmw;

    private array $citroen;

    public function __construct()
    {
        $this->faker = Factory::create('FR-fr');

        $this->audi = [
            'Cabriolet',
            'Q2',
            'Q3',
            'Q5',
            'Q7',
            'Q8',
            'R8',
            'Rs3',
            'Rs4',
            'Rs5',
            'Rs7',
            'S3',
            'S4',
            'S4 Avant',
            'S4 Cabriolet',
            'S5',
            'S7',
            'S8',
            'SQ5',
            'SQ7',
            'Tt',
            'Tts',
            'V8',
        ];
        $this->bmw = [
            'M3',
            'M4',
            'M5',
            'M535',
            'M6',
            'M635',
            'Serie 1',
            'Serie 2',
            'Serie 3',
            'Serie 4',
            'Serie 5',
            'Serie 6',
            'Serie 7',
            'Serie 8',
        ];
        $this->citroen = [
            'C1',
            'C15',
            'C2',
            'C25',
            'C25D',
            'C25E',
            'C25TD',
            'C3',
            'C3 Aircross',
            'C3 Picasso',
            'C4',
            'C4 Picasso',
            'C5',
            'C6',
            'C8',
            'Ds3',
            'Ds4',
            'Ds5',
        ];
    }

    public function load(ObjectManager $manager): void
    {
        $categories = [];

        // Ajout des voitures
        foreach ($this->getBrandData() as [$brand]) {
            $car = new Car();

            $car->setBrand($brand);

            if ($brand === 'Audi') {
                $car->setModel($this->audi);
            }

            if ($brand === 'BMW') {
                $car->setModel($this->bmw);
            }

            if ($brand === 'Citroën') {
                $car->setModel($this->citroen);
            }

            $manager->persist($car);
        }

        // Ajout des categories
        foreach ($this->getCategoryData() as [$name]) {
            $category = new Category();

            $category->setName($name);

            $manager->persist($category);
            $categories[] = $category;
        }

        // ajout des annonces
        for ($i = 1; $i <= 30; $i++) {
            $ad = new Ad();

            $title = $this->faker->sentence();
            $content = '<p>' . join('</p><p>', $this->faker->paragraphs(5)) . '</p>';

            $category = $categories[mt_rand(0, count($categories) - 1)];

            $ad
                ->setTitle($title)
                ->setContent($content)
                ->setCreatedAt($this->faker->dateTimeBetween('-6 months'))
                ->setCategory($category)
            ;

            $manager->persist($ad);
        }

        $manager->flush();
    }

    /**
     * Recuperation des noms des categories
     *
     * @return array
     */
    private function getCategoryData(): array
    {
        $categories = [];

        foreach ($this->generateCategories() as $category) {
            $categories[] = [
                $category['name'],
            ];
        }

        return $categories;
    }

    /**
     * Recuperation des marques des voitures
     *
     * @return array
     */
    private function getBrandData(): array
    {
        $brands = [];

        foreach ($this->generateBrands() as $brand) {
            $brands[] = [
                $brand['brand'],
            ];
        }

        return $brands;
    }

    /**
     * On genere les categories
     *
     * @return \string[][]
     */
    private function generateCategories(): array
    {
        return [
            ['name' => 'Job'],
            ['name' => 'Automotive'],
            ['name' => 'Real Estate'],
        ];
    }

    /**
     * On genere les noms des marques de voitures
     *
     * @return \string[][]
     */
    private function generateBrands(): array
    {
        return [
            ['brand' => 'Audi'],
            ['brand' => 'BMW'],
            ['brand' => 'Citroën'],
        ];
    }
}
