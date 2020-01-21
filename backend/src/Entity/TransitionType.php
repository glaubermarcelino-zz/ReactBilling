<?php
/**
 * Created by PhpStorm.
 * User: giovane
 * Date: 1/13/20
 * Time: 11:28 AM
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class TransitionType
 * @package App\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="transition_type")
 */
class TransitionType
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
    private $type;

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
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return TransitionType
     */
    public function setType(string $type): self
    {
        $this->type = $type;
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
     * @return TransitionType
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

}