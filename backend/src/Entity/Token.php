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
 * Class Token
 * @package App\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="token",
 *     indexes={
 *          @ORM\Index(name="idx_token", columns={"access_token"})
 *     }
 * )
 */
class Token
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
     * @var AppClient
     *
     * @ORM\ManyToOne(targetEntity="AppClient")
     * @ORM\JoinColumn(name="id_app_client", referencedColumnName="id", onDelete="CASCADE")
     */
    private $app_client;

    /**
     * @var Login
     *
     * @ORM\ManyToOne(targetEntity="Login")
     * @ORM\JoinColumn(name="id_login", referencedColumnName="id", onDelete="CASCADE")
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $access_token;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $refresh_token;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $expires_in;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return AppClient
     */
    public function getAppClient(): AppClient
    {
        return $this->app_client;
    }

    /**
     * @param AppClient $app_client
     * @return Token
     */
    public function setAppClient(AppClient $app_client): self
    {
        $this->app_client = $app_client;
        return $this;
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
     * @return Token
     */
    public function setLogin(Login $login): self
    {
        $this->login = $login;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    /**
     * @param string $access_token
     * @return Token
     */
    public function setAccessToken(string $access_token): self
    {
        $this->access_token = $access_token;
        return $this;
    }

    /**
     * @return string
     */
    public function getRefreshToken(): string
    {
        return $this->refresh_token;
    }

    /**
     * @param string $refresh_token
     * @return Token
     */
    public function setRefreshToken(string $refresh_token): self
    {
        $this->refresh_token = $refresh_token;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getExpiresIn(): \DateTime
    {
        return $this->expires_in;
    }

    /**
     * @param \DateTime $expires_in
     * @return Token
     */
    public function setExpiresIn(\DateTime $expires_in): self
    {
        $this->expires_in = $expires_in;
        return $this;
    }

}