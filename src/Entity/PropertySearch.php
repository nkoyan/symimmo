<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

class PropertySearch
{
    private $maxPrice;

    /**
     * @Assert\Range(min="10", max="400")
     */
    private $minSurface;

    private $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    public function setMinSurface(int $minSurface): self
    {
        $this->minSurface = $minSurface;
        return $this;
    }

    public function getMinSurface(): ?int
    {
        return $this->minSurface;
    }

    public function setMaxPrice(int $maxPrice): self
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function setTags(Collection $tags): void
    {
        $this->tags = $tags;
    }
}