<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PizzaRepository")
 */
class Pizza
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Price", mappedBy="pizza", orphanRemoval=true)
     */
    protected $prices;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ingredient", inversedBy="pizzas")
     */
    protected $ingredients;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $creamBase;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $tomatoBase;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $active = false;

    public function __construct()
    {
        $this->prices = new ArrayCollection();
        $this->ingredients = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
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
     * @return Collection|Price[]
     */
    public function getPrices(): Collection
    {
        return $this->prices;
    }

    public function addPrice(Price $price): self
    {
        if (!$this->prices->contains($price)) {
            $this->prices[] = $price;
            $price->setPizza($this);
        }

        return $this;
    }

    public function removePrice(Price $price): self
    {
        if ($this->prices->contains($price)) {
            $this->prices->removeElement($price);
            // set the owning side to null (unless already changed)
            if ($price->getPizza() === $this) {
                $price->setPizza(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ingredient[]
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredient $ingredient): self
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients[] = $ingredient;
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): self
    {
        if ($this->ingredients->contains($ingredient)) {
            $this->ingredients->removeElement($ingredient);
        }

        return $this;
    }

    public function getCreamBase(): ?bool
    {
        return $this->creamBase;
    }

    public function setCreamBase(bool $creamBase): self
    {
        $this->creamBase = $creamBase;

        return $this;
    }

    public function getTomatoBase(): ?bool
    {
        return $this->tomatoBase;
    }

    public function setTomatoBase(bool $tomatoBase): self
    {
        $this->tomatoBase = $tomatoBase;

        return $this;
    }

    public function getMomentPizzaStart(): ?\DateTimeInterface
    {
        return $this->momentPizzaStart;
    }

    public function setMomentPizzaStart(?\DateTimeInterface $momentPizzaStart): self
    {
        $this->momentPizzaStart = $momentPizzaStart;

        return $this;
    }

    public function getMomentPizzaEnd(): ?\DateTimeInterface
    {
        return $this->momentPizzaEnd;
    }

    public function setMomentPizzaEnd(?\DateTimeInterface $momentPizzaEnd): self
    {
        $this->momentPizzaEnd = $momentPizzaEnd;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }
}
