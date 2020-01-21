<?php
/**
 * Created by PhpStorm.
 * User: giovane
 * Date: 1/13/20
 * Time: 10:54 AM
 */

namespace App\Services\Token;


use App\Helpers\NotificationError;
use App\Services\Token\Validation\TokenForm;
use Doctrine\ORM\EntityManagerInterface;
use App\Services\Token\Storage\TokenStorage;

class TokenService
{
    private $entityManager;
    private $tokenStorage;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->tokenStorage = new TokenStorage($this->entityManager);
    }


    public function accessToken(NotificationError $notificationError, array $data)
    {
        $isAccessToken = false;
        $isValid = TokenForm::validateRegister($notificationError, $data);

        if($isValid) {
            $isAccessToken = $this->tokenStorage->accessToken($notificationError, $data);
        }

        if($isValid && $isAccessToken) {
            return $isAccessToken;
        }

        return false;
    }
}