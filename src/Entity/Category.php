<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Product::class)]
    private $products;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: VatRate::class)]
    private $vatRates;

    public function __construct()
    {
        $this->products = new ArrayCollection();
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
            $vatRate->setCategory($this);
        }

        return $this;
    }

    public function removeVatRate(VatRate $vatRate): self
    {
        if ($this->vatRates->removeElement($vatRate)) {
            // set the owning side to null (unless already changed)
            if ($vatRate->getCategory() === $this) {
                $vatRate->setCategory(null);
            }
        }

        return $this;
    }

}
