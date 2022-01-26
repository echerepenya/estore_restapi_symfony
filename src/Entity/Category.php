<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ApiResource(
    normalizationContext: [
        'groups' => ['category:read'],
    ],
    denormalizationContext: [
        'groups' => ['category:write'],
    ],
)]
#[UniqueEntity("name")]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(name: 'name', type: 'string', length: 255, unique: true)]
    #[Groups(["category:read", "category:write", "product:read", "vat:read", "vat:write"])]
    private $name;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: VatRate::class)]
    private $vat_rates;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Product::class)]
    #[Groups("category:read")]
    private $products;

    public function __construct()
    {
        $this->vat_rates = new ArrayCollection();
        $this->products = new ArrayCollection();
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

    /**
     * @return Collection|VatRate[]
     */
    public function getVatRates(): Collection
    {
        return $this->vat_rates;
    }

    public function addVatRate(VatRate $vatRate): self
    {
        if (!$this->vat_rates->contains($vatRate)) {
            $this->vat_rates[] = $vatRate;
            $vatRate->setCategory($this);
        }

        return $this;
    }

    public function removeVatRate(VatRate $vatRate): self
    {
        if ($this->vat_rates->removeElement($vatRate)) {
            // set the owning side to null (unless already changed)
            if ($vatRate->getCategory() === $this) {
                $vatRate->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setCategory($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getCategory() === $this) {
                $product->setCategory(null);
            }
        }

        return $this;
    }

}
