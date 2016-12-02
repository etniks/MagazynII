<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ShoppingCart
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ShoppingCartRepository")
 */
class ShoppingCart
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var array
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Products")
     * @ORM\JoinTable(
     *     name="product_to_basket",
     *     joinColumns={@ORM\JoinColumn(name="basket",referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="product",referencedColumnName="id")}
     *     )
     */
    private $containProducts;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->containProducts=new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set containProducts
     *
     * @param Products $containProducts
     *
     * @return ShoppingCart
     */

    public function addProduct(Products $containProducts)
    {
        $this->containProducts->add($containProducts);
        return $this;

    }
    /**
     * Get containProducts
     *
     * @return array
     */
    public function getContainProducts()
    {
        return $this->containProducts;
    }


}
