<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CommodityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CommodityRepository::class)]
#[ApiResource]
class Commodity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[Assert\NotBlank]
    #[ORM\Column]
    private ?int $price = null;

    #[ORM\OneToMany(mappedBy: 'commodityId', targetEntity: CommodityType::class)]
    private Collection $commodityTypes;

    public function __construct()
    {
        $this->commodityTypes = new ArrayCollection();
    }

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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, CommodityType>
     */
    public function getCommodityTypes(): Collection
    {
        return $this->commodityTypes;
    }

    public function addCommodityType(CommodityType $commodityType): self
    {
        if (!$this->commodityTypes->contains($commodityType)) {
            $this->commodityTypes->add($commodityType);
            $commodityType->setCommodityId($this);
        }

        return $this;
    }

    public function removeCommodityType(CommodityType $commodityType): self
    {
        if ($this->commodityTypes->removeElement($commodityType)) {
            // set the owning side to null (unless already changed)
            if ($commodityType->getCommodityId() === $this) {
                $commodityType->setCommodityId(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->title;
    }
}
