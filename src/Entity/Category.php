<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Ad::class)]
    private $ads;

    #[ORM\OneToOne(targetEntity: Automotive::class)]
    #[ORM\JoinColumn(name: 'automotive_id', referencedColumnName: 'id')]
    private $automotive;

    #[ORM\OneToOne(targetEntity: Job::class)]
    #[ORM\JoinColumn(name: 'job_id', referencedColumnName: 'id')]
    private $job;

    #[ORM\OneToOne(targetEntity: RealEstate::class)]
    #[ORM\JoinColumn(name: 'real_estate_id', referencedColumnName: 'id')]
    private $realEstate;

    public function __construct()
    {
        $this->ads = new ArrayCollection();
        $this->automotive = new ArrayCollection();
        $this->job = new ArrayCollection();
        $this->realEstate = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection
     */
    public function getAds(): Collection
    {
        return $this->ads;
    }

    public function addAd(Ad $ad): self
    {
        if (!$this->ads->contains($ad)) {
            $this->ads[] = $ad;
            $ad->setCategory($this);
        }

        return $this;
    }

    public function removeAd(Ad $ad): self
    {
        if ($this->ads->removeElement($ad)) {
            // set the owning side to null (unless already changed)
            if ($ad->getCategory() === $this) {
                $ad->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getAutomotive(): Collection
    {
        return $this->automotive;
    }

    /**
     * @return Collection
     */
    public function getJob(): Collection
    {
        return $this->job;
    }

    /**
     * @return Collection
     */
    public function getRealEstate(): Collection
    {
        return $this->realEstate;
    }
}
