<?php

namespace App\Entity;

use App\Repository\LocaleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;

#[ORM\Entity(repositoryClass: LocaleRepository::class)]
/**
 * @ApiResource()
 */
class Locale
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 8)]
    private $iso;

    #[ORM\OneToOne(mappedBy: 'locale', targetEntity: Country::class, cascade: ['persist', 'remove'])]
    private $country;

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

    public function getIso(): ?string
    {
        return $this->iso;
    }

    public function setIso(string $iso): self
    {
        $this->iso = $iso;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(Country $country): self
    {
        // set the owning side of the relation if necessary
        if ($country->getLocale() !== $this) {
            $country->setLocale($this);
        }

        $this->country = $country;

        return $this;
    }
}
