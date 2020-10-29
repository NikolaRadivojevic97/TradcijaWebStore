<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Controller\ResetPasswordAction;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiFilter;

/**
 * @ApiFilter(
 *     SearchFilter::class,
 *     properties={
 *         "username": "exact"
 *     }
 * )
 * @ApiResource(
 *     itemOperations={
 *         "get"={
 *             "security"="is_granted('ROLE_ADMIN') or (is_granted('ROLE_USER') and object == user)",
 *             "normalization_context"={
 *                 "groups"={"get-user"}
 *             }
 *         },
 *         "put"={
 *             "security"="is_granted('ROLE_USER') and object == user",
 *             "denormalization_context"={
 *                 "groups"={"put-user"}
 *             },
 *             "normalization_context"={
 *                 "groups"={"get-user"}
 *             },
 *              "validation_groups"={"put-user"}
 *         },
 *         "put-reset-password"={
 *             "security"="is_granted('ROLE_USER') and object == user",
 *             "method"="PUT",
 *             "path"="/users/{id}/reset-password",
 *             "controller"=ResetPasswordAction::class,
 *             "denormalization_context"={
 *                 "groups"={"put-reset-password"}
 *             },
 *             "validation_groups"={"put-reset-password"}
 *         }
 *     },
 *     collectionOperations={
 *     "get"={
 *             "normalization_context"={
 *                 "groups"={"get-users"}
 *             }
 *         },
 *         "post"={
 *             "denormalization_context"={
 *                 "groups"={"post-user"}
 *             },
 *             "normalization_context"={
 *                 "groups"={"get-user"}
 *             },
 *             "validation_groups"={"post-user"}
 *         }
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity("username", groups={"post"})
 */
class User implements UserInterface
{

    const ROLE_USER = 'ROLE_USER';
    const ROLE_ADMIN = 'ROLE_ADMIN';


    const DEFAULT_ROLES = [self::ROLE_USER];
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"get-users"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get-user", "post-user", "get-users"})
     * @Assert\NotBlank(groups={"post-user"})
     * @Assert\Length(max=255, groups={"post-user"})
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"post-user"})
     * @Assert\NotBlank(groups={"post-user"})
     * @Assert\Regex(
     *     pattern="/(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{7,}/",
     *     message="Password must be seven characters long and contain at least one digit, one upper case letter and one lower case letter",
     *     groups={"post-user"}
     * )
     */
    private $password;
    /**
     * @Groups({"post-user"})
     * @Assert\NotBlank(groups={"post-user"})
     * @Assert\Expression(
     *     "this.getPassword() === this.getRetypedPassword()",
     *     message="Passwords does not match",
     *     groups={"post-user"}
     * )
     */
    private $retypedPassword;

    /**
     * @Groups({"put-reset-password"})
     * @Assert\NotBlank(groups={"put-reset-password"})
     * @Assert\Regex(
     *     pattern="/(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{7,}/",
     *     message="Password must be seven characters long and contain at least one digit, one upper case letter and one lower case letter",
     *     groups={"put-reset-password"}
     * )
     */
    private $newPassword;

    /**
     * @Groups({"put-reset-password"})
     * @Assert\NotBlank(groups={"put-reset-password"})
     * @Assert\Expression(
     *     "this.getNewPassword() === this.getNewRetypedPassword()",
     *     message="Passwords does not match",
     *     groups={"put-reset-password"}
     * )
     */
    private $newRetypedPassword;

    /**
     * @Groups({"put-reset-password"})
     * @Assert\NotBlank(groups={"put-reset-password"})
     * @UserPassword(groups={"put-reset-password"})
     */
    private $oldPassword;

    /**
     * @ORM\Column(type="simple_array", length=200)
     */
    private $roles;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $passwordChangeDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enabled;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $confirmationToken;

    /**
     * @ORM\OneToOne(targetEntity=ShippingInfo::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $info;




//    /**
//     * @OneToOne(targetEntity="App\Entity\ShippingInfo", mappedBy="user")
//     * @Groups({"get-user", "post-user", "put-user"})
//     */
//    private $info;
    public function __construct()
    {
        $this->roles = self::DEFAULT_ROLES;
        $this->enabled = false;
        $this->confirmationToken = null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPasswordChangeDate(): ?int
    {
        return $this->passwordChangeDate;
    }

    public function setPasswordChangeDate(?int $passwordChangeDate): self
    {
        $this->passwordChangeDate = $passwordChangeDate;

        return $this;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getConfirmationToken(): ?string
    {
        return $this->confirmationToken;
    }

    public function setConfirmationToken(?string $confirmationToken): self
    {
        $this->confirmationToken = $confirmationToken;

        return $this;
    }

//    public function getInfo(): ?ShippingInfo
//    {
//        return $this->info;
//    }
//
//    public function setInfo(?ShippingInfo $info): self
//    {
//        $this->info = $info;
//
//        return $this;
//    }


    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {

    }
    public function getRetypedPassword()
    {
        return $this->retypedPassword;
    }

    public function setRetypedPassword($retypedPassword): void
    {
        $this->retypedPassword = $retypedPassword;
    }

    public function getNewPassword(): ?string
    {
        return $this->newPassword;
    }

    public function setNewPassword($newPassword): void
    {
        $this->newPassword = $newPassword;
    }

    public function getNewRetypedPassword(): ?string
    {
        return $this->newRetypedPassword;
    }

    public function setNewRetypedPassword($newRetypedPassword): void
    {
        $this->newRetypedPassword = $newRetypedPassword;
    }

    public function getOldPassword(): ?string
    {
        return $this->oldPassword;
    }

    public function setOldPassword($oldPassword): void
    {
        $this->oldPassword = $oldPassword;
    }

    public function getInfo(): ?ShippingInfo
    {
        return $this->info;
    }

    public function setInfo(ShippingInfo $info): self
    {
        $this->info = $info;

        return $this;
    }




}
