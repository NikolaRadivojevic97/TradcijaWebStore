<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\BrandRepository")
 * @ApiResource(
 *     itemOperations={
 *         "get"={
 *             "normalization_context"={
 *                 "groups"={"get-brand"}
 *             }
 *          }
 *     },
 *     collectionOperations={
 *         "get"={
 *             "normalization_context"={
 *                 "groups"={"get-brand"}
 *             }
 *          },
 *         "post"={
 *             "security"="is_granted('ROLE_ADMIN')",
 *              "denormalization_context"={
 *                   "groups"={"post-brand"}
 *              }
 *         }
 *     }
 * )
 */
class Brand
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
     * @Groups({"post-brand", "get-brand", "get-car", "get-shopping-cart", "get-order"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Model", mappedBy="brand")
     * @Groups({"get-brand"})
     */
    private $models;

    public function __construct()
    {
        $this->models = new ArrayCollection();

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
    public function getModels(): Collection
    {
        return $this->models;
    }

    public function setModel(Model $model)
    {
        $this->models->add($model);
    }

    public function removeModel(Model $model)
    {
        $this->models->removeElement($model);
    }


}
