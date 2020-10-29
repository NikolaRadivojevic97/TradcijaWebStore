<?php

namespace App\Entity;


use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\CoversRepository")

 * @ApiResource(
 *     itemOperations={
 *         "get"={
 *             "normalization_context"={
 *                 "groups"={"get-cover"}
 *             }
 *          },
 *     "put"={
 *            "denormalization_context"={
 *                   "groups"={"put-cover"}
 *              }
 *          }
 *     },
 *     collectionOperations={
 *         "get"={
 *             "normalization_context"={
 *                 "groups"={"get-cover"}
 *             }
 *          },
 *         "post"={
 *             "security"="is_granted('ROLE_ADMIN')",
 *              "denormalization_context"={
 *                   "groups"={"post-cover"}
 *              }
 *         }
 *     }
 * )
 */
class Covers
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"get-cover", "get-car","get-shopping-cart", "get-order"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1000)
     * @Assert\NotBlank()
     * @Assert\Length(max=1000)
     * @Groups({"get-cover", "put-cover", "get-car", "post-cover", "get-shopping-cart", "get-order"})
     */
    private $url;

    /**
     * @ORM\Column(type="float")
     * @Groups({"get-cover", "put-cover", "get-car", "post-cover", "get-shopping-cart", "get-order"})
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Combination", inversedBy="covers")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"get-cover", "get-car", "post-cover", "get-shopping-cart", "get-order"})
     */
    private $combination;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Car", inversedBy="covers")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"post-cover", "get-shopping-cart", "get-order"})
     */
    private $car;

    /**
     * @ORM\ManyToMany(targetEntity=ShoppingCart::class, mappedBy="products")
     */
    private $shoppingCarts;

//    /**
//     * @ORM\ManyToMany(targetEntity="App\Entity\ShoppingCart", mappedBy="products")
//     */
//    private $shoppingCarts;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->shoppingCarts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCombination(): ?Combination
    {
        return $this->combination;
    }

    public function setCombination(?Combination $combination): self
    {
        $this->combination = $combination;

        return $this;
    }

    public function getCar(): ?Car
    {
        return $this->car;
    }

    public function setCar(?Car $car): self
    {
        $this->car = $car;

        return $this;
    }

//    /**
//     * @return Collection|ShoppingCart[]
//     */
//    public function getShoppingCart(): Collection
//    {
//        return $this->shoppingCarts;
//    }
//
//    public function addShoppingCart(ShoppingCart $shoppingCart): self
//    {
//        if (!$this->shoppingCarts->contains($shoppingCart)) {
//            $this->shoppingCarts[] = $shoppingCart;
//            $shoppingCart->addCover($this);
//        }
//
//        return $this;
//    }
//
//    public function removeShoppingCart(ShoppingCart $shoppingCart): self
//    {
//        if ($this->shoppingCarts->contains($shoppingCart)) {
//            $this->shoppingCarts->removeElement($shoppingCart);
//            $shoppingCart->removeCover($this);
//        }
//
//        return $this;
//    }

/**
 * @return Collection|ShoppingCart[]
 */
public function getShoppingCarts(): Collection
{
    return $this->shoppingCarts;
}

public function addShoppingCart(ShoppingCart $shoppingCart): self
{
    if (!$this->shoppingCarts->contains($shoppingCart)) {
        $this->shoppingCarts[] = $shoppingCart;
        $shoppingCart->addProduct($this);
    }

    return $this;
}

public function removeShoppingCart(ShoppingCart $shoppingCart): self
{
    if ($this->shoppingCarts->contains($shoppingCart)) {
        $this->shoppingCarts->removeElement($shoppingCart);
        $shoppingCart->removeProduct($this);
    }

    return $this;
}

}
