<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Controller\AddToCartAction;
use App\Controller\RemoveFromChartAction;
use App\Controller\AddCustomerAction;
use App\Controller\CheckOutAction;



/**
 * @ORM\Entity(repositoryClass="App\Repository\ShoppingCartRepository")
 * @ApiResource(
 *     itemOperations={
 *         "get"={
 *             "normalization_context"={
 *                 "groups"={"get-shopping-cart"}
 *             }
 *          },
 *         "add-cover"={
 *             "method"="PUT",
 *             "path"="/shopping_carts/{id}/add-product",
 *             "controller"=AddToCartAction::class,
 *             "denormalization_context"={
 *                 "groups"={"add-product"}
 *             },
 *             "validation_groups"={"add-product"}
 *         },
 *     "remove-cover"={
 *             "method"="PUT",
 *             "path"="/shopping_carts/{id}/remove-product",
 *             "controller"=RemoveFromChartAction::class,
 *             "denormalization_context"={
 *                 "groups"={"remove-product"}
 *             },
 *             "validation_groups"={"remove-product"}
 *         },
 *     "add-customer"={
 *             "method"="PUT",
 *             "path"="/shopping_carts/{id}/add-customer",
 *             "controller"=AddCustomerAction::class,
 *             "denormalization_context"={
 *                 "groups"={"add-customer"}
 *             },
 *             "validation_groups"={"add-customer"}
 *         },
 *     "check-out"={
 *             "method"="PUT",
 *             "path"="/shopping_carts/{id}/check-out",
 *             "controller"=CheckOutAction::class,
 *             "denormalization_context"={
 *                 "groups"={"check-out"}
 *             },
 *             "validation_groups"={"check-out"}
 *         }
 *     },
 *     collectionOperations={
 *         "post"={
 *             "denormalization_context"={
 *                 "groups"={"post-shopping-cart"}
 *             },
 *              "normalization_context"={
 *                 "groups"={"get-new-cart"}
 *             }
 *         }
 *     }
 * )
 */
class ShoppingCart
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"get-shopping-cart", "get-order","get-new-cart"})
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"get-order"})
     */
    private $active;

    /**
     * @ORM\Column(type="float")
     * @Groups({"get-shopping-cart"})
     */
    private $total;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ShippingInfo", inversedBy="shoppingCarts", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"add-customer", "get-order"})
     */
    private $customer;

//    /**
//     * @ORM\ManyToMany(targetEntity="App\Entity\Covers", inversedBy="shoppingCarts",cascade={"persist"})
//     * @ORM\JoinTable()
//     * @Groups({"get-shopping-cart", "get-order"})
//     */
//    private $products;


    /**
     * @Groups({"add-product"})
     */
    private $addProduct;
    /**
     * @Groups({"remove-product"})
     */
    private $removeProduct;
    /**
     * @Groups({"check-out"})
     */
    private $payment;

    /**
     * @ORM\OneToOne(targetEntity=Orders::class, mappedBy="shoppingCart", cascade={"persist", "remove"})
     */
    private $orders;

    /**
     * @ORM\ManyToMany(targetEntity=Covers::class, inversedBy="shoppingCarts")
     * @Groups({"get-shopping-cart", "get-order"})
     */
    private $products;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->total=0;
        $this->active=false;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getCustomer(): ShippingInfo
    {
        return $this->customer;
    }

    public function setCustomer(?ShippingInfo $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

//    /**
//     * @return Collection|Covers[]
//     */
//    public function getCovers(): Collection
//    {
//        return $this->products;
//    }
//
//    public function addCover(Covers $cover): self
//    {
//        if (!$this->products->contains($cover)) {
//            $this->products[] = $cover;
//            $cover->addShoppingCart($this);
//            $this->total=$this->getTotal()+$cover->getPrice();
//            $this->active=true;
//        }
//
//        return $this;
//    }
//
//    public function removeCover(Covers $cover): self
//    {
//        if ($this->products->contains($cover)) {
//            $this->products->removeElement($cover);
//            $cover->removeShoppingCart($this);
//            $this->total=$this->getTotal()-$cover->getPrice();
//        }
//
//        return $this;
//    }


    /**
     * @return mixed
     */
    public function getAddProduct()
    {
        return $this->addProduct;
    }
    public function setAddProduct(Covers $cover): self
    {
        $this->addProduct = $cover;

        return $this;
    }
    /**
     * @return mixed
     */
    public function getRemoveProduct()
    {
        return $this->removeProduct;
    }
    public function setRemoveProduct(Covers $cover): self
    {
        $this->removeProduct = $cover;

        return $this;
    }
    /**
     * @return mixed
     */
    public function getPayment()
    {
        return $this->payment;
    }
    public function setPayment(Paymnet $payment): self
    {
        $this->payment = $payment;

        return $this;
    }

    public function getOrders(): ?Orders
    {
        return $this->orders;
    }

    public function setOrders(Orders $orders): self
    {
        $this->orders = $orders;

        // set the owning side of the relation if necessary
        if ($orders->getShoppingCart() !== $this) {
            $orders->setShoppingCart($this);
            $orders->setTotal($this->getTotal());
        }

        return $this;
    }

    /**
     * @return Collection|Covers[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Covers $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $this->total=$this->getTotal()+$product->getPrice();
            $this->active=true;
        }

        return $this;
    }

    public function removeProduct(Covers $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            $this->total=$this->getTotal()-$product->getPrice();

        }

        return $this;
    }
}
