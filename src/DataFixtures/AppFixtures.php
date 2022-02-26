<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Ad;
use App\Entity\User;
use App\Entity\Category;
use App\Entity\Automotive;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private \Faker\Generator $faker;

    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
        $this->faker = Factory::create('FR-fr');
    }

    public function load(ObjectManager $manager): void
    {
        $this->loadUser($manager);
        $this->loadAutomotives($manager);
        $this->loadAds($manager);
    }

    public function loadUser(ObjectManager $manager)
    {
        $user = new User();
        $user
            ->setUsername('ahmed@mze.net')
            ->setPassword($this->passwordHasher->hashPassword($user, 'password'))
            ->setRoles(['ROLE_ADMIN'])
        ;

        $manager->persist($user);
        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    private function loadAutomotives(ObjectManager $manager)
    {
        foreach ($this->getBrandData() as [$brand]) {
            if ($brand === 'Audi') {
                foreach ($this->getAudiModelData() as [$name]) {
                    $automotive = new Automotive();
                    $automotive
                        ->setName($name)
                        ->setBrand('Audi')
                    ;

                    $manager->persist($automotive);
                    $this->setReference($brand, $automotive);
                }
            }

            if ($brand === 'BMW') {
                foreach ($this->getBmwModelData() as [$name]) {
                    $automotive = new Automotive();
                    $automotive
                        ->setName($name)
                        ->setBrand('BMW')
                    ;

                    $manager->persist($automotive);
                    $this->setReference($brand, $automotive);
                }
            }

            if ($brand === 'Citroën') {
                foreach ($this->getCitroenModelData() as [$name]) {
                    $automotive = new Automotive();
                    $automotive
                        ->setName($name)
                        ->setBrand('Citroën')
                    ;

                    $manager->persist($automotive);
                    $this->setReference($brand, $automotive);
                }
            }
        }

        $manager->flush();
    }

    private function loadAds(ObjectManager $manager)
    {
        $categories = [];
        $vehicles = $manager->getRepository(Automotive::class)->findAll();

        // Ajout des categories
        foreach ($this->getCategoryData() as [$name]) {
            $category = (new Category())->setName($name);

            $manager->persist($category);
            $categories[] = $category;
        }

        // ajout des annonces
        for ($i = 1; $i <= 30; $i++) {
            $title = $this->faker->sentence();
            $content = '<p>' . join('</p><p>', $this->faker->paragraphs(5)) . '</p>';

            $category = $categories[mt_rand(0, count($categories) - 1)];
            $vehicle = $vehicles[array_rand($vehicles)];

            $ad = new Ad();

            $ad->setTitle($title);
            $ad->setContent($content);
            $ad->setCreatedAt($this->faker->dateTimeBetween('-6 months'));
            $ad->setCategory($category);

            if ($category->getName() === 'Automotive') {
                $ad->setVehicle($vehicle);
            }

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
     * Recuperation des noms des marques
     *
     * @return array
     */
    private function getBrandData(): array
    {
        $brands = [];

        foreach ($this->generateBrands() as $brand) {
            $brands[] = [$brand['brand']];
        }

        return $brands;
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

    /**
     * Recuperation des models Audi
     *
     * @return array
     */
    private function getAudiModelData(): array
    {
        $models = [];

        foreach ($this->generateAudiModels() as $model) {
            $models[] = [$model['name']];
        }

        return $models;
    }

    /**
     * On genere les models Audi
     *
     * @return \string[][]
     */
    private function generateAudiModels(): array
    {
        return [
            ['name' => 'Cabriolet'],
            ['name' => 'Q2'],
            ['name' => 'Q3'],
            ['name' => 'Q5'],
            ['name' => 'Q7'],
            ['name' => 'Q8'],
            ['name' => 'R8'],
            ['name' => 'Rs3'],
            ['name' => 'Rs4'],
            ['name' => 'Rs5'],
            ['name' => 'Rs7'],
            ['name' => 'S3'],
            ['name' => 'S4'],
            ['name' => 'S4 Avant'],
            ['name' => 'S4 Cabriolet'],
            ['name' => 'S5'],
            ['name' => 'S6'],
            ['name' => 'S7'],
            ['name' => 'S8'],
            ['name' => 'SQ5'],
            ['name' => 'SQ7'],
            ['name' => 'Tt'],
            ['name' => 'Tts'],
            ['name' => 'V8'],
        ];
    }

    /**
     * Recuperation des models BMW
     *
     * @return array
     */
    private function getBmwModelData(): array
    {
        $models = [];

        foreach ($this->generateBmwModels() as $model) {
            $models[] = [$model['name']];
        }

        return $models;
    }

    /**
     * On genere les models BMW
     *
     * @return \string[][]
     */
    private function generateBmwModels(): array
    {
        return [
            ['name' => 'M3'],
            ['name' => 'M4'],
            ['name' => 'M5'],
            ['name' => 'M535'],
            ['name' => 'M635'],
            ['name' => 'Serie 1'],
            ['name' => 'Serie 2'],
            ['name' => 'Serie 3'],
            ['name' => 'Serie 4'],
            ['name' => 'Serie 5'],
            ['name' => 'Serie 6'],
            ['name' => 'Serie 7'],
            ['name' => 'Serie 8'],
        ];
    }

    /**
     * Recuperation des models Ctroen
     *
     * @return array
     */
    private function getCitroenModelData(): array
    {
        $models = [];

        foreach ($this->generateCitroenModels() as $model) {
            $models[] = [$model['name']];
        }

        return $models;
    }

    /**
     * On genere les models Ctroen
     *
     * @return \string[][]
     */
    private function generateCitroenModels(): array
    {
        return [
            ['name' => 'C1'],
            ['name' => 'C15'],
            ['name' => 'C2'],
            ['name' => 'C25'],
            ['name' => 'C25D'],
            ['name' => 'C25E'],
            ['name' => 'C25TD'],
            ['name' => 'C3 Aircross'],
            ['name' => 'C3 Picasso'],
            ['name' => 'C4'],
            ['name' => 'C4 Picasso'],
            ['name' => 'C5'],
            ['name' => 'C6'],
            ['name' => 'C8'],
            ['name' => 'Ds3'],
            ['name' => 'Ds4'],
            ['name' => 'Ds5'],
        ];
    }
}
