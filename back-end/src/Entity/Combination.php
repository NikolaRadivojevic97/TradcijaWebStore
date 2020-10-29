<?php

namespace App\Entity;


use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\CombinationRepository")

 * @ApiResource(
 *     itemOperations={
 *         "get"={
 *             "normalization_context"={
 *                 "groups"={"get-combination"}
 *             }
 *          }
 *     },
 *     collectionOperations={
 *         "get"={
 *             "normalization_context"={
 *                 "groups"={"get-combination"}
 *             }
 *          },
 *         "post"={
 *             "security"="is_granted('ROLE_ADMIN')",
 *              "denormalization_context"={
 *                   "groups"={"post-combination"}
 *              }
 *         }
 *     }
 * )
 */
class Combination
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"get-combination"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     * @Groups({"get-combination", "post-combination", "get-cover", "get-car", "get-shopping-cart", "get-order"})
     */
    private $color1;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     * @Groups({"get-combination", "post-combination", "get-cover", "get-car", "get-shopping-cart", "get-order"})
     */
    private $color2;

    /**
     * @ORM\Column(type="string", length=1000)
     * @Assert\NotBlank()
     * @Assert\Length(max=1000)
     * @Groups({"get-combination", "post-combination", "get-cover", "get-car", "get-shopping-cart","get-order"})
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     * @Groups({"get-combination", "post-combination", "get-cover", "get-car", "get-shopping-cart", "get-order"})
     */
    private $description;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Covers", mappedBy="combination")
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

    public function getColor1(): ?string
    {
        return $this->color1;
    }

    public function setColor1(string $color1): self
    {
        $this->color1 = $color1;

        return $this;
    }

    public function getColor2(): ?string
    {
        return $this->color2;
    }

    public function setColor2(string $color2): self
    {
        $this->color2 = $color2;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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
