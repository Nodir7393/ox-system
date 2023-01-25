<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CommodityTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommodityTypeRepository::class)]
#[ApiResource]
class CommodityType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $size = null;

    #[ORM\Column(length: 100)]
    private ?string $color = null;

    #[ORM\ManyToOne(inversedBy: 'commodityTypes')]
    private ?Commodity $commodityId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getCommodityId(): ?Commodity
    {
        return $this->commodityId;
    }

    public function setCommodityId(?Commodity $commodityId): self
    {
        $this->commodityId = $commodityId;

        return $this;
    }
}
