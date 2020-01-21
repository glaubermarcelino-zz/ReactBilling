<?php
/**
 * Created by PhpStorm.
 * User: giovane
 * Date: 1/16/20
 * Time: 3:39 PM
 */

namespace App\Services\Category;

use App\Helpers\NotificationError;
use Doctrine\ORM\EntityManagerInterface;
use App\Services\Category\Storage\CategoryStorage;

class CategoryService
{
    private $categoryStorage;
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->categoryStorage = new CategoryStorage($this->entityManager);
    }

    public function listAllByType(NotificationError $notificationError, int $idType)
    {
        $isData = $this->categoryStorage->listAllByType($notificationError, $idType);
        if($isData) {
            return $isData;
        }
        return false;
    }
}