<?php
/**
 * Created by PhpStorm.
 * User: giovane
 * Date: 1/13/20
 * Time: 12:33 PM
 */

namespace App\Services\User\Validation;


use App\Entity\User;
use App\Helpers\NotificationError;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class EmailRegistered
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function emailRegistered(NotificationError $notificationError, string $email): bool
    {
        $userEntity = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

        if($userEntity) {
            $notificationError->setStatusCode(Response::HTTP_CONFLICT);
            $notificationError->pushError('email', 'email is already registered');
            return true;
        }

        $notificationError->setStatusCode(Response::HTTP_NOT_FOUND);
        $notificationError->pushError('email', 'email not registered');
        return false;
    }
}