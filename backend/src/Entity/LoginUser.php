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
 * Class LoginUser
 * @package App\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="login_user")
 */
class LoginUser
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
     * @var Login
     *
     * @ORM\ManyToOne(targetEntity="Login")
     * @ORM\JoinColumn(name="id_login", referencedColumnName="id", onDelete="CASCADE")
     */
    private $login;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id", onDelete="CASCADE")
     */
    private $user;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Login
     */
    public function getLogin(): Login
    {
        return $this->login;
    }

    /**
     * @param Login $login
     * @return LoginUser
     */
    public function setLogin(Login $login): self
    {
        $this->login = $login;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return LoginUser
     */
    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

}