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

    #[ORM\OneToMany(mappedBy: 'categories', targetEntity: Ad::class)]
    private $ads;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Automotive::class)]
    private $automotives;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Job::class)]
    private $jobs;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: RealEstate::class)]
    private $realEstates;

    public function __construct()
    {
        $this->ads = new ArrayCollection();
        $this->automotives = new ArrayCollection();
        $this->jobs = new ArrayCollection();
        $this->realEstates = new ArrayCollection();
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
    public function getAutomotives(): Collection
    {
        return $this->automotives;
    }

    public function addAutomotive(Automotive $automotive): self
    {
        if (!$this->automotives->contains($automotive)) {
            $this->automotives[] = $automotive;
            $automotive->setCategory($this);
        }

        return $this;
    }

    public function removeAutomotive(Automotive $automotive): self
    {
        if ($this->automotives->removeElement($automotive)) {
            // set the owning side to null (unless already changed)
            if ($automotive->getCategory() === $this) {
                $automotive->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getJobs(): Collection
    {
        return $this->jobs;
    }

    public function addJob(Job $job): self
    {
        if (!$this->jobs->contains($job)) {
            $this->jobs[] = $job;
            $job->setCategory($this);
        }

        return $this;
    }

    public function removeJob(Job $job): self
    {
        if ($this->jobs->removeElement($job)) {
            // set the owning side to null (unless already changed)
            if ($job->getCategory() === $this) {
                $job->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getRealEstates(): Collection
    {
        return $this->realEstates;
    }

    public function addRealEstate(RealEstate $realEstate): self
    {
        if (!$this->realEstates->contains($realEstate)) {
            $this->realEstates[] = $realEstate;
            $realEstate->setCategory($this);
        }

        return $this;
    }

    public function removeRealEstate(RealEstate $realEstate): self
    {
        if ($this->realEstates->removeElement($realEstate)) {
            // set the owning side to null (unless already changed)
            if ($realEstate->getCategory() === $this) {
                $realEstate->setCategory(null);
            }
        }

        return $this;
    }
}
