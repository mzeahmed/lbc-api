<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AutomotiveRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AutomotiveRepository::class)]
class Automotive
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups('ad:read')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups('ad:read')]
    private ?string $name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups('ad:read')]
    private ?string $brand;

    #[ORM\OneToMany(mappedBy: 'vehicle', targetEntity: Ad::class)]
    private $ads;

    public function __construct()
    {
        $this->ads = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return Collection<int, Ad>
     */
    public function getAds(): Collection
    {
        return $this->ads;
    }

    public function addAd(Ad $ad): self
    {
        if (! $this->ads->contains($ad)) {
            $this->ads[] = $ad;
            $ad->setVehicle($this);
        }

        return $this;
    }

    public function removeAd(Ad $ad): self
    {
        if ($this->ads->removeElement($ad)) {
            // set the owning side to null (unless already changed)
            if ($ad->getVehicle() === $this) {
                $ad->setVehicle(null);
            }
        }

        return $this;
    }
}
