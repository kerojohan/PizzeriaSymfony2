<?php

namespace Pizzeria\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pizza
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pizzeria\TestBundle\Entity\PizzaRepository")
 */
class Pizza
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="selling_price", type="float")
     */
    private $sellingPrice;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Pizza
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set sellingPrice
     *
     * @param float $sellingPrice
     * @return Pizza
     */
    public function setSellingPrice($sellingPrice)
    {
        $this->sellingPrice = $sellingPrice;

        return $this;
    }

    /**
     * Get sellingPrice
     *
     * @return float 
     */
    public function getSellingPrice()
    {
        return $this->sellingPrice;
    }

    /** @ORM\ManyToMany(targetEntity="Pizzeria\TestBundle\Entity\Ingredient") */
    private $ingredients;



    /**
     * Set ingredients
     *
     * @param \Pizzeria\TestBundle\Entity\Ingredient $ingredients
     * @return Pizza
     */
    public function setIngredients(\Pizzeria\TestBundle\Entity\Ingredient $ingredients = null)
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    /**
     * Get ingredients
     *
     * @return \Pizzeria\TestBundle\Entity\Ingredient 
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ingredients = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ingredients
     *
     * @param \Pizzeria\TestBundle\Entity\Ingredient $ingredients
     * @return Pizza
     */
    public function addIngredient(\Pizzeria\TestBundle\Entity\Ingredient $ingredients)
    {
        $this->ingredients[] = $ingredients;

        return $this;
    }

    /**
     * Remove ingredients
     *
     * @param \Pizzeria\TestBundle\Entity\Ingredient $ingredients
     */
    public function removeIngredient(\Pizzeria\TestBundle\Entity\Ingredient $ingredients)
    {
        $this->ingredients->removeElement($ingredients);
    }
    
    
    
}
