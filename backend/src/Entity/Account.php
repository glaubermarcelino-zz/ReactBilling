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
}