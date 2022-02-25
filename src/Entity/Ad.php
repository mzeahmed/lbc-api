<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AdRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AdRepository::class)]
class Ad
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups('ad:read')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups('ad:read')]
    #[Assert\NotBlank]
    private ?string $title;

    #[ORM\Column(type: 'text')]
    #[Groups('ad:read')]
    #[Assert\NotBlank]
    private ?string $content;

    #[ORM\Column(type: 'datetime')]
    #[Groups('ad:read')]
    private ?\DateTimeInterface $createdAt;

    #[ORM\ManyToOne(targetEntity: Automotive::class, inversedBy: 'ads')]
    #[Groups('ad:read')]
    private ?Automotive $vehicle;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'ads')]
    #[Groups('ad:read')]
    private ?Category $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getVehicle(): ?Automotive
    {
        return $this->vehicle;
    }

    public function setVehicle(?Automotive $vehicle): self
    {
        $this->vehicle = $vehicle;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
