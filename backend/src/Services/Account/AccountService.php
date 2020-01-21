<?php
/**
 * Created by PhpStorm.
 * User: giovane
 * Date: 1/14/20
 * Time: 11:40 AM
 */

namespace App\Services\Account;


use App\Helpers\NotificationError;
use Doctrine\ORM\EntityManagerInterface;
use App\Services\Account\Validation\AccountForm;
use App\Services\Account\Storage\AccountStorage;

class AccountService
{
    private $entityManager;
    private $accountStorage;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->accountStorage = new AccountStorage($this->entityManager);
    }

    public function register(NotificationError $notificationError, array $data): ?bool
    {
        $isAccountOk = false;

        $isValid = AccountForm::validateRegister($notificationError, $data);

        if($isValid) {
            $isAccountOk= $this->accountStorage->register($notificationError, $data);
        }

        if($isAccountOk && $isValid) {
            return true;
        }

        return false;
    }

    public function listAllByUser(NotificationError $notificationError, string $token)
    {
        $isData = $this->accountStorage->listAllByUser($notificationError, $token);
        if($isData) {
            return $isData;
        }
        return false;
    }

}