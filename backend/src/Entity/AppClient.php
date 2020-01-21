<?php
/**
 * Created by PhpStorm.
 * User: giovane
 * Date: 1/10/20
 * Time: 7:03 PM
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class AppClient
 * @package App\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="app_client")
 */
class AppClient
{
    /**
     * @var integer
     *
     * @ORM\Id()
     * @ORM\Column(type="integer", length=4)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50)
     */
    private $app_key;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     */
    private $app_client;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50)
     */
    private $description;

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
    public function getAppKey(): string
    {
        return $this->app_key;
    }

    /**
     * @param string $app_key
     * @return AppClient
     */
    public function setAppKey(string $app_key): self
    {
        $this->app_key = $app_key;
        return $this;
    }

    /**
     * @return string
     */
    public function getAppClient(): string
    {
        return $this->app_client;
    }

    /**
     * @param string $app_client
     * @return AppClient
     */
    public function setAppClient(string $app_client): self
    {
        $this->app_client = $app_client;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return AppClient
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

}