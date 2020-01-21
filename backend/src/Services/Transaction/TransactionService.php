<?php
/**
 * Created by PhpStorm.
 * User: giovane
 * Date: 1/15/20
 * Time: 4:13 PM
 */

namespace App\Services\Transaction;


use App\Helpers\NotificationError;
use App\Services\Transaction\Validation\TransactionForm;
use Doctrine\ORM\EntityManagerInterface;
use App\Services\Transaction\Storage\TransactionStorage;

class TransactionService
{

    private $entityManager;
    private $transactionStorage;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->transactionStorage = new TransactionStorage($this->entityManager);
    }

    public function register(NotificationError $notificationError, array $data): ?bool
    {
        $isTransactionOk = false;

        $isValid = TransactionForm::validateRegister($notificationError, $data);

        if($isValid) {
            $isTransactionOk = $this->transactionStorage->register($notificationError, $data);
        }

        if($isValid && $isTransactionOk) {
            return true;
        }

        return false;
    }

    public function listAllByDashboard(NotificationError $notificationError, $month, string $token)
    {
        if ($month) {
            $isData = $this->transactionStorage->listAllDashboard($notificationError, $month, $token);
            if($isData) {
                return $isData;
            }
        } else {
            $notificationError->pushError('validation', [
                'date' => 'Please make sure you typed value a valid'
            ]);
        }
        return false;
    }

    public function listAllWithFilter(NotificationError $notificationError, array $data)
    {
        if($data['date']) {
            $isData = $this->transactionStorage->listAllWithFilter($notificationError, $data);
            if($isData) {
                return $isData;
            }
        } else {
          $notificationError->pushError('validation', [
              'date' => 'Please make sure you typed value a valid'
          ]);
        }

        return false;
    }
}