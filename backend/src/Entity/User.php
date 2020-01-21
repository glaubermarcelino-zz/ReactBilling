<?php
/**
 * Created by PhpStorm.
 * User: giovane
 * Date: 1/10/20
 * Time: 6:53 PM
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package App\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="user",
 *     indexes={
 *          @ORM\Index(name="idx_cpf", columns={"cpf"}),
 *          @ORM\Index(name="idx_email", columns={"email"})
 *     },
 *     uniqueConstraints={
 *          @ORM\UniqueConstraint(name="unique_cpf", columns={"cpf"}),
 *          @ORM\UniqueConstraint(name="unique_email", columns={"email"})
 *     }
 * )
 */
class User
{
    /**
     * @var integer
     *
     * @ORM\Id()
     * @ORM\Column(type="integer", length=8)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=40)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=40, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=15, unique=true)
     */
    private $cpf;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=12, nullable=true)
     */
    private $cell_phone;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default": 0})
     */
    private $admin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $date_created;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->setAdmin(false);
        $this->setDateCreated(new \DateTime("now", new \DateTimeZone("UTC")));
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getCpf(): string
    {
        return $this->cpf;
    }

    /**
     * @param string $cpf
     * @return User
     */
    public function setCpf(string $cpf): self
    {
        $this->cpf = $cpf;
        return $this;
    }

    /**
     * @return string
     */
    public function getCellPhone(): string
    {
        return $this->cell_phone;
    }

    /**
     * @param ? $cell_phone
     * @return User
     */
    public function setCellPhone($cell_phone): self
    {
        $this->cell_phone = $cell_phone;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->admin;
    }

    /**
     * @param bool $admin
     * @return User
     */
    public function setAdmin(bool $admin): self
    {
        $this->admin = $admin;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateCreated(): \DateTime
    {
        return $this->date_created;
    }

    /**
     * @param \DateTime $date_created
     * @return User
     */
    public function setDateCreated(\DateTime $date_created): self
    {
        $this->date_created = $date_created;
        return $this;
    }

}