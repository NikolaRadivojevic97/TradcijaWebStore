<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiFilter;
use App\Repository\OrdersRepository;
use App\Controller\CheckOutAction;

/**
 * @ApiFilter(
 *     SearchFilter::class,
 *     properties={
 *         "shoppingCart.customer": "exact"
 *     }
 * )
 * @ApiResource(
 *     itemOperations={
 *         "get"={
 *             "security"="is_granted('ROLE_ADMIN') or is_granted('ROLE_USER')",
 *             "normalization_context"={
 *                 "groups"={"get-order"}
 *             }
 *         },
 *         "put"={
 *             "security"="is_granted('ROLE_ADMIN')",
 *             "denormalization_context"={
 *                 "groups"={"change-status"}
 *             },
 *              "validation_groups"={"change-status"}
 *         },
 *     },
 *     collectionOperations={
 *     "get"={
 *             "security"="is_granted('ROLE_ADMIN') or is_granted('ROLE_USER')",
 *             "normalization_context"={
 *                 "groups"={"get-order"}
 *             }
 *         },
 *     "check-out"={
 *             "method"="POST",
 *             "path"="/orders",
 *             "controller"=CheckOutAction::class,
 *             "denormalization_context"={
 *                 "groups"={"post-order"}
 *             },
 *             "validation_groups"={"post-order"}
 *         }
 *     }
 * )
 * @ORM\Entity(repositoryClass=OrdersRepository::class)
 */
class Orders
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"get-order"})
     */
    private $id;

    /**
     * @Assert\NotBlank(groups={"change-status"})
     * @Assert\Length(max=255,groups={"change-status"})
     * @Groups({"get-order", "change-status"})
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @Groups({"get-order"})
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @Groups({"get-order"})
     * @ORM\Column(type="float")
     */
    private $total;

    /**
     * @ORM\OneToOne(targetEntity=ShoppingCart::class, inversedBy="orders", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"get-order", "post-order"})
     */
    private $shoppingCart;

    /**
     * @ORM\ManyToOne(targetEntity=Paymnet::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"get-order", "post-order"})
     */
    private $paymnet;



    public function __construct()
    {
        $this->status="naruceno";
        $this->date=new DateTime();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function setDate(DateTime $date): self
    {
        $this->date = $date;

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

//    public function getShoppingCart(): ?ShoppingCart
//    {
//        return $this->shoppingCart;
//    }
//
//    public function setShoppingCart(ShoppingCart $shoppingCart): self
//    {
//        $this->shoppingCart = $shoppingCart;
//
//        return $this;
//    }

public function getShoppingCart(): ?ShoppingCart
{
    return $this->shoppingCart;
}

public function setShoppingCart(ShoppingCart $shoppingCart): self
{
    $this->shoppingCart = $shoppingCart;
    $shoppingCart->setOrders($this);
    return $this;
}

public function getPaymnet(): ?Paymnet
{
    return $this->paymnet;
}

public function setPaymnet(?Paymnet $paymnet): self
{
    $this->paymnet = $paymnet;
    $paymnet->addOrder($this);
    return $this;
}
}
