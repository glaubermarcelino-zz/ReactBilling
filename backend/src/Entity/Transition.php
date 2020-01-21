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
 * Class Transition
 * @package App\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="transition")
 */
class Transition
{
    /**
     * @var integer
     *
     * @ORM\Id()
     * @ORM\Column(type="integer", length=100)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Account
     *
     * @ORM\ManyToOne(targetEntity="Account")
     * @ORM\JoinColumn(name="id_account", referencedColumnName="id", onDelete="CASCADE")
     */
    private $account;

    /**
     * @var TransitionType
     *
     * @ORM\ManyToOne(targetEntity="TransitionType")
     * @ORM\JoinColumn(name="id_transition_type", referencedColumnName="id", onDelete="CASCADE")
     */
    private $type;

    /**
     * @var TransitionCategory
     *
     * @ORM\ManyToOne(targetEntity="TransitionCategory")
     * @ORM\JoinColumn(name="id_transition_category", referencedColumnName="id", onDelete="CASCADE")
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $value;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $fixed;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50)
     */
    private $note;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=20)
     */
    private $tag;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Account
     */
    public function getAccount(): Account
    {
        return $this->account;
    }

    /**
     * @param Account $account
     * @return Transition
     */
    public function setAccount(Account $account): self
    {
        $this->account = $account;
        return $this;
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
     * @return Transition
     */
    public function setType(TransitionType $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return TransitionCategory
     */
    public function getCategory(): TransitionCategory
    {
        return $this->category;
    }

    /**
     * @param TransitionCategory $category
     * @return Transition
     */
    public function setCategory(TransitionCategory $category): self
    {
        $this->category = $category;
        return $this;
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
     * @return Transition
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }


    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     * @return Transition
     */
    public function setValue(float $value): self
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return Transition
     */
    public function setDate(\DateTime $date): self
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return bool
     */
    public function isFixed(): bool
    {
        return $this->fixed;
    }

    /**
     * @param bool $fixed
     * @return Transition
     */
    public function setFixed(bool $fixed): self
    {
        $this->fixed = $fixed;
        return $this;
    }

    /**
     * @return string
     */
    public function getNote(): string
    {
        return $this->note;
    }

    /**
     * @param string $note
     * @return Transition
     */
    public function setNote(string $note): self
    {
        $this->note = $note;
        return $this;
    }

    /**
     * @return string
     */
    public function getTag(): string
    {
        return $this->tag;
    }

    /**
     * @param string $tag
     * @return Transition
     */
    public function setTag(string $tag): self
    {
        $this->tag = $tag;
        return $this;
    }

}