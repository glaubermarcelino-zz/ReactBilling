<?php
/**
 * Created by PhpStorm.
 * User: giovane
 * Date: 1/10/20
 * Time: 6:52 PM
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Login
 * @package App\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="login",
 *     indexes={
 *          @ORM\Index(name="idx_email", columns={"email"})
 *     },
 *     uniqueConstraints={
 *          @ORM\UniqueConstraint(name="unique_email", columns={"email"})
 *     }
 * )
 */
class Login
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
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     */
    private $password;

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
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Login
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return Login
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

}