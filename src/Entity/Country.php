<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
/**
 * @ApiResource()
 */
class Country
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToOne(inversedBy: 'country', targetEntity: Locale::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $locale;

    #[ORM\OneToMany(mappedBy: 'country', targetEntity: Vat::class)]
    private $vats;

    public function __construct()
    {
        $this->vats = new ArrayCollection();
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
     * @return Collection|Vat[]
     */
    public function getVats(): Collection
    {
        return $this->vats;
    }

    public function addVat(Vat $vat): self
    {
        if (!$this->vats->contains($vat)) {
            $this->vats[] = $vat;
            $vat->setCountry($this);
        }

        return $this;
    }

    public function removeVat(Vat $vat): self
    {
        if ($this->vats->removeElement($vat)) {
            // set the owning side to null (unless already changed)
            if ($vat->getCountry() === $this) {
                $vat->setCountry(null);
            }
        }

        return $this;
    }
}
