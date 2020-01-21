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
     * @var TransitionType
     *
     * @ORM\ManyToOne(targetEntity="TransitionType")
     * @ORM\JoinColumn(name="id_transition_type", referencedColumnName="id", onDelete="CASCADE")
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=40)
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50, nullable=true)
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
     * @return TransitionType
     */
    public function getType(): TransitionType
    {
        return $this->type;
    }

    /**
     * @param TransitionType $type
     * @return TransitionCategory
     */
    public function setType(TransitionType $type): self
    {
        $this->type = $type;
        return $this;
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

    public function toArray()
    {
        return array(
            'id' => $this->getId(),
            'category' => $this->getCategory()
        );
    }

}