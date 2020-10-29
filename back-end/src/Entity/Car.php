<?php

namespace App\Entity;


use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\CarRepository")
 * @ApiResource(
 *     itemOperations={
 *         "get"={
 *             "normalization_context"={
 *                 "groups"={"get-car"}
 *             }
 *          }
 *     },
 *     collectionOperations={
 *         "get"={
 *             "normalization_context"={
 *                 "groups"={"get-car"}
 *             }
 *          },
 *         "post"={
 *             "security"="is_granted('ROLE_ADMIN')",
 *              "denormalization_context"={
 *                   "groups"={"post-car"}
 *              }
 *         }
 *     }
 * )
 */
class Car
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"get-car"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     * @Groups({"get-car","post-car", "get-shopping-cart", "get-order"})
     */
    private $bodyType;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     * @Groups({"get-car", "post-car", "get-shopping-cart", "get-order"})
     */
    private $generation;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     * @Groups({"get-car", "post-car", "get-shopping-cart", "get-order"})
     */
    private $equipmentLevel;

    /**
     * @ORM\Column(type="string", length=1000)
     * @Assert\NotBlank()
     * @Assert\Length(max=1000)
     * @Groups({"get-car", "post-car", "get-shopping-cart", "get-order"})
     */
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Model", inversedBy="cars")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"get-car", "post-car", "get-shopping-cart", "get-order"})
     */
    private $model;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Covers", mappedBy="car")
     * @Groups({"get-car"})
     */
    private $covers;
    public function __construct()
    {
        $this->covers = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBodyType(): ?string
    {
        return $this->bodyType;
    }

    public function setBodyType(string $bodyType): self
    {
        $this->bodyType = $bodyType;

        return $this;
    }

    public function getGeneration(): ?string
    {
        return $this->generation;
    }

    public function setGeneration(string $generation): self
    {
        $this->generation = $generation;

        return $this;
    }

    public function getEquipmentLevel(): ?string
    {
        return $this->equipmentLevel;
    }

    public function setEquipmentLevel(string $equipmentLevel): self
    {
        $this->equipmentLevel = $equipmentLevel;

        return $this;
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

    public function getModel(): ?Model
    {
        return $this->model;
    }

    public function setModel(?Model $model): self
    {
        $this->model = $model;

        return $this;
    }
    public function getCovers(): Collection
    {
        return $this->covers;
    }

    public function addCover(Covers $cover)
    {
        $this->covers->add($cover);
    }

    public function removeCover(Covers $cover)
    {
        $this->covers->removeElement($cover);
    }


}
