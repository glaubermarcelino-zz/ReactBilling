<?php
/**
 * Created by PhpStorm.
 * User: giovane
 * Date: 1/13/20
 * Time: 10:43 AM
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Account
 * @package App\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="account")
 */
class Account
{
    /**
     * @var integer
     *
     * @ORM\Id()
     * @ORM\Column(type="integer", length=2)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=20)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(type="float", nullable=true, options={"default": null})
     */
    private $sale;

    /**
     * Account constructor.
     */
    public function __construct()
    {
        $this->setSale(null);
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
     * @return Account
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return float
     */
    public function getSale(): float
    {
        return $this->sale;
    }

    /**
     * @param float $sale
     * @return Account
     */
    public function setSale(?float $sale): self
    {
        $this->sale = $sale;
        return $this;
    }

}