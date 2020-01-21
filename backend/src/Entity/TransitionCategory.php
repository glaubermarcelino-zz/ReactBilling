<?php
/**
 * Created by PhpStorm.
 * User: giovane
 * Date: 1/13/20
 * Time: 11:29 AM
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class TransitionCategory
 * @package App\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="transition_category")
 */
class TransitionCategory
{
    /**
     * @var integer
     *
     * @ORM\Id()
     * @ORM\Column(type="integer", length=10)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=40)
     */
    private $category;

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
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @param string $category
     * @return TransitionCategory
     */
    public function setCategory(string $category): self
    {
        $this->category = $category;
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
     * @return TransitionCategory
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

}