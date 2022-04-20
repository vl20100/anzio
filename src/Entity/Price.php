<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PriceRepository")
 */
class Price
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $size;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pizza", inversedBy="prices")
     * @ORM\JoinColumn(nullable=true)
     */
    private $pizza;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PizzaOfMonth", inversedBy="prices")
     * @ORM\JoinColumn(nullable=true)
     */
    private $pizzaOfMonth;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getPizza(): ?Pizza
    {
        return $this->pizza;
    }

    public function setPizza(?Pizza $pizza): self
    {
        $this->pizza = $pizza;

        return $this;
    }

    public function getPizzaOfMonth(): ?PizzaOfMonth
    {
        return $this->pizzaOfMonth;
    }

    public function setPizzaOfMonth(?PizzaOfMonth $pizzaOfMonth): self
    {
        $this->pizzaOfMonth = $pizzaOfMonth;

        return $this;
    }
}
