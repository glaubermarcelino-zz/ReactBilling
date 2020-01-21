<?php
/**
 * Created by PhpStorm.
 * User: giovane
 * Date: 1/13/20
 * Time: 12:24 PM
 */

namespace App\Services\User;


use App\Helpers\PasswordManager;
use App\Helpers\NotificationError;
use Doctrine\ORM\EntityManagerInterface;
use App\Services\User\Validation\UserForm;
use App\Services\User\Storage\UserStorage;
use App\Services\User\Validation\EmailRegistered;

class UserService
{
    private $entityManager;
    private $userStorage;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->userStorage = new UserStorage($this->entityManager);
    }

    public function register(NotificationError $notificationError, array $data)
    {
        $isUserOk = $isEmailRegistered = false;
        $passwordManager = new PasswordManager();

        $isValid = UserForm::validateRegister($notificationError, $data);

        if($isValid) {
            $emailRegistered = new EmailRegistered($this->entityManager);
            $isEmailRegistered = $emailRegistered->emailRegistered($notificationError, $data['email']);
        }

        if($isValid && !$isEmailRegistered) {
            if(is_null($data['password'])) {
                $data['password'] = $passwordManager->generatePassword(10);
            }

            $isUserOk= $this->userStorage->register($notificationError, $passwordManager, $data);
        }

        if($isValid && $isUserOk && !$isEmailRegistered) {
            return $isUserOk;
        }
        return false;
    }

    public function lisOneLogged(NotificationError $notificationError, ?string $token)
    {
        $isData = $this->userStorage->lisOneLogged($notificationError, $token);
        if($isData) {
            return $isData;
        }
        return false;
    }
}