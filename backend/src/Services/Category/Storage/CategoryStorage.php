<?php
/**
 * Created by PhpStorm.
 * User: giovane
 * Date: 1/16/20
 * Time: 3:40 PM
 */

namespace App\Services\Category\Storage;

use App\Entity\TransitionCategory;
use App\Helpers\NotificationError;
use Doctrine\ORM\EntityManagerInterface;

class CategoryStorage
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function listAllByType(NotificationError $notificationError, int $idType)
    {
        /** @var TransitionCategory[] $category */
        $category = $this->entityManager
            ->getRepository(TransitionCategory::class)
            ->findBy(['type' => $idType]);

        if($category) {
            $category = array_map(function (TransitionCategory $a) {
                $a = $a->toArray();
                return $a;
            }, $category);
            return $category;
        }

        return false;
    }
}