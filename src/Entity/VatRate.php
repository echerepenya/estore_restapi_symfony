<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\VatRateRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: VatRateRepository::class)]
#[ApiResource(
    normalizationContext: [
        'groups' => ['vat:read'],
    ],
    denormalizationContext: [
        'groups' => ['vat:write'],
    ],
)]
#[UniqueEntity(
    fields:["country", "category"],
    message:"This fields combination is already in use."
    )]
class VatRate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Country::class, inversedBy: 'vatRates')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["vat:read", "vat:write"])]
    private $country;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'vat_rates')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["vat:read", "vat:write"])]
    private $category;

    #[ORM\Column(type: 'decimal', precision: 4, scale: 2)]
    /**
     * @Assert\Range(
     *      min = 0,
     *      max = 20,
     *      notInRangeMessage = "Values from {{ min }} to {{ max }} are acceptable",
     * )
     */
    #[Groups(["vat:read", "vat:write"])]
    private $vat;

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

    public function getVat(): ?string
    {
        return $this->vat;
    }

    public function setVat(string $vat): self
    {
        $this->vat = $vat;

        return $this;
    }
}
