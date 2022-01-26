<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CountryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
#[ApiResource(
    normalizationContext: [
        'groups' => ['country:read'],
    ],
    denormalizationContext: [
        'groups' => ['country:write'],
    ],
)]
#[UniqueEntity("name")]
class Country
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    #[Groups(["country:read", "country:write", "locale:read", "locale:write", "vat:read", "vat:write"])]
    private $name;

    #[ORM\OneToOne(inversedBy: 'country', targetEntity: Locale::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["country:read", "country:write"])]
    private $locale;

    #[ORM\OneToMany(mappedBy: 'country', targetEntity: VatRate::class)]
    private $vatRates;

    public function __construct()
    {
        $this->vatRates = new ArrayCollection();
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

    public function getLocale(): ?Locale
    {
        return $this->locale;
    }

    public function setLocale(Locale $locale): self
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * @return Collection|VatRate[]
     */
    public function getVatRates(): Collection
    {
        return $this->vatRates;
    }

    public function addVatRate(VatRate $vatRate): self
    {
        if (!$this->vatRates->contains($vatRate)) {
            $this->vatRates[] = $vatRate;
            $vatRate->setCountry($this);
        }

        return $this;
    }

    public function removeVatRate(VatRate $vatRate): self
    {
        if ($this->vatRates->removeElement($vatRate)) {
            // set the owning side to null (unless already changed)
            if ($vatRate->getCountry() === $this) {
                $vatRate->setCountry(null);
            }
        }

        return $this;
    }
}
