<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\LocaleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;

#[ORM\Entity(repositoryClass: LocaleRepository::class)]
#[ApiResource(
    normalizationContext: [
        'groups' => ['locale:read'],
    ],
    denormalizationContext: [
        'groups' => ['locale:write'],
    ],
)]
/**
 * @ApiFilter(BooleanFilter::class, properties={"iso1"})
 */
#[UniqueEntity("name")]
#[UniqueEntity("iso1")]
class Locale
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    #[Groups(["locale:read", "locale:write", "country:read", "country:write"])]
    #[Assert\Valid()]
    private $name;

    #[ORM\Column(type: 'string', length: 5, unique: true)]
    #[Groups(["locale:read", "locale:write", "country:read", "country:write"])]
    #[Assert\Valid()]
    private $iso1;

    #[ORM\OneToOne(mappedBy: 'locale', targetEntity: Country::class, cascade: ['persist', 'remove'])]
    #[ApiProperty(readableLink: false, writableLink: false)]
    #[Groups(["locale:read", "locale:write"])]
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

    public function getIso1(): ?string
    {
        return $this->iso1;
    }

    public function setIso1(string $iso1): self
    {
        $this->iso1 = $iso1;

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
