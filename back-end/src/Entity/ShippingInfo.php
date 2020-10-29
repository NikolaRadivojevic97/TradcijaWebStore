<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     itemOperations={
 *         "get",
 *          "put"
 *     },
 *     collectionOperations={
 *         "post"
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ShippingInfoRepository")
 */
class ShippingInfo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"get-user"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get-user", "post-user","put-user", "add-customer", "get-order"})
     * @Assert\NotBlank(groups={"post-user", "put-user", "add-customer"})
     * @Assert\Length(max=255, groups={"post-user","put-user", "add-customer"})
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get-user", "post-user", "put-user", "add-customer", "get-order"})
     * @Assert\NotBlank(groups={"post-user", "put-user", "add-customer"})
     * @Assert\Length(max=255, groups={"post-user", "put-user", "add-customer"})
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get-user", "post-user", "put-user", "add-customer", "get-order"})
     * @Assert\NotBlank(groups={"post-user", "put-user", "add-customer"})
     * @Assert\Length(max=255, groups={"post-user", "put-user", "add-customer"})
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get-user", "post-user", "put-user", "add-customer", "get-order"})
     * @Assert\NotBlank(groups={"post-user", "put-user", "add-customer"})
     * @Assert\Length(max=255, groups={"post-user", "put-user", "add-customer"})
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get-user", "post-user", "put-user", "add-customer", "get-order"})
     * @Assert\NotBlank(groups={"post-user", "put-user", "add-customer"})
     * @Assert\Length(max=255, groups={"post-user", "put-user", "add-customer"})
     */
    private $zipCode;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get-user", "post-user", "put-user", "add-customer", "get-order"})
     * @Assert\NotBlank(groups={"post-user", "put-user", "add-customer"})
     * @Assert\Length(max=255, groups={"post-user", "put-user", "add-customer"})
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get-user", "post-user", "put-user","add-customer", "get-order"})
     * @Assert\Email(groups={"post-user", "put-user","add-customer"})
     */
    private $email;
//    /**
//     * @OneToOne(targetEntity="App\Entity\User", inversedBy="info")
//     */
//    private $user;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ShoppingCart", mappedBy="customer")
     */
    private $shoppingCarts;



    public function __construct()
    {
        $this->shoppingCarts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
//    public function getUser(): User
//    {
//        return $this->user;
//    }
//
//    public function setUser(User $user): self
//    {
//        $this->user = $user;
//
//        return $this;
//    }
    public function getShoppingCarts(): Collection
    {
        return $this->shoppingCarts;
    }

    public function addShoppingCart(ShoppingCart $shoppingCarts)
    {
        $this->shoppingCarts->add($shoppingCarts);
    }

    public function removeShoppingCart(ShoppingCart $shoppingCarts)
    {
        $this->shoppingCarts->removeElement($shoppingCarts);
    }





}
