<?php

namespace App\Entity;

use App\Repository\CarModelRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarModelRepository::class)]
class CarModel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $model;

    #[ORM\ManyToOne(targetEntity: CarBrand::class, inversedBy: 'models')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CarBrand $brand;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getBrand(): ?CarBrand
    {
        return $this->brand;
    }

    public function setBrand(?CarBrand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }
}
