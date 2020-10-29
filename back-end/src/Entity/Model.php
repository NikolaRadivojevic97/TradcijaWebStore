<?php

namespace App\Entity;


use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ModelRepository")

 * @ApiResource(
 *     itemOperations={
 *         "get"={
 *             "normalization_context"={
 *                 "groups"={"get-model"}
 *             }
 *          }
 *     },
 *     collectionOperations={
 *         "get"={
 *             "normalization_context"={
 *                 "groups"={"get-model"}
 *             }
 *          },
 *         "post"={
 *             "security"="is_granted('ROLE_ADMIN')",
 *              "denormalization_context"={
 *                   "groups"={"post-model"}
 *              }
 *         }
 *     }
 * )
 */
class Model
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"get-brand"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     * @Groups({"get-brand","post-model", "get-car", "get-shopping-cart", "get-order"})
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Brand", inversedBy="models")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"post-model", "get-car", "get-shopping-cart", "get-order"})
     */
    private $brand;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Car", mappedBy="model")
     */
    private $cars;
    public function __construct()
    {
        $this->cars = new ArrayCollection();
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

    public function getBrand(): Brand
    {
        return $this->brand;
    }

    public function setBrand(Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }
    public function getCars(): Collection
    {
        return $this->cars;
    }

    public function addCar(Car $car)
    {
        $this->cars->add($car);
    }

    public function removeCar(Car $car)
    {
        $this->cars->removeElement($car);
    }

}
