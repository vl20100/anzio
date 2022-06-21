<?php

namespace App\Entity;

use App\Utils\StringHelper;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IngredientRepository")
 */
class Ingredient
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $vegetarian;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Pizza", mappedBy="ingredients")
     */
    private $pizzas;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\PizzaOfMonth", mappedBy="ingredients")
     */
    private $pizzasOfMonth;

    public function __construct()
    {
        $this->pizzas = new ArrayCollection();
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

    public function getSlug(): ?string
    {
        return StringHelper::getInstance()->getSlug($this->getName());
    }

    public function getVegetarian(): ?bool
    {
        return $this->vegetarian;
    }

    public function setVegetarian(bool $vegetarian): self
    {
        $this->vegetarian = $vegetarian;

        return $this;
    }

    /**
     * @return Collection|Pizza[]
     */
    public function getPizzas(): Collection
    {
        return $this->pizzas;
    }

    public function addPizza(Pizza $pizza): self
    {
        if (!$this->pizzas->contains($pizza)) {
            $this->pizzas[] = $pizza;
            $pizza->addIngredient($this);
        }

        return $this;
    }

    public function removePizza(Pizza $pizza): self
    {
        if ($this->pizzas->contains($pizza)) {
            $this->pizzas->removeElement($pizza);
            $pizza->removeIngredient($this);
        }

        return $this;
    }

    /**
     * @return Collection|PizzaOfMonth[]
     */
    public function getPizzasOfMonth(): Collection
    {
        return $this->pizzasOfMonth;
    }

    public function addPizzaOfMonth(PizzaOfMonth $pizzaOfMonth): self
    {
        if (!$this->pizzasOfMonth->contains($pizzaOfMonth)) {
            $this->pizzasOfMonth[] = $pizzaOfMonth;
            $pizzaOfMonth->addIngredient($this);
        }

        return $this;
    }

    public function removePizzaOfMonth(PizzaOfMonth $pizzaOfMonth): self
    {
        if ($this->pizzasOfMonth->contains($pizzaOfMonth)) {
            $this->pizzasOfMonth->removeElement($pizzaOfMonth);
            $pizzaOfMonth->removeIngredient($this);
        }

        return $this;
    }
}
