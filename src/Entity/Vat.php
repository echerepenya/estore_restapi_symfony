<?php

namespace App\Entity;

use App\Repository\VatRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;

#[ORM\Entity(repositoryClass: VatRepository::class)]
/**
 * @ApiResource()
 */
class Vat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Country::class, inversedBy: 'vats')]
    #[ORM\JoinColumn(nullable: false)]
    private $country;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'vats')]
    #[ORM\JoinColumn(nullable: false)]
    private $category;

    #[ORM\Column(type: 'float')]
    private $vat_rate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

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

    public function getVatRate(): ?float
    {
        return $this->vat_rate;
    }

    public function setVatRate(float $vat_rate): self
    {
        $this->vat_rate = $vat_rate;

        return $this;
    }
}
