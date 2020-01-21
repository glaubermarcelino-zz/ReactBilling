<?php
/**
 * Created by PhpStorm.
 * User: giovane
 * Date: 1/14/20
 * Time: 11:40 AM
 */

namespace App\Services\Account\Storage;


use App\Entity\User;
use App\Entity\Account;
use App\Entity\UserAccount;
use App\Helpers\UserFinder;
use App\Helpers\NotificationError;
use Doctrine\DBAL\ConnectionException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class AccountStorage
{
    private $userFinder;
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->userFinder = new UserFinder($this->entityManager);
    }

    public function register(NotificationError $notificationError, array $data)
    {
        $isAccountOk = $isUserAccountOk = false;

        $accountEntity = new Account();
        $userAccountEntity = new UserAccount();

        /** @var User $userEntity */
        $userEntity = $this->userFinder->getByToken($data['token']);

        $this->entityManager->getConnection()->beginTransaction();

        if($userEntity) {
            $accountEntity
                ->setName($data['name'])
                ->setSale($data['sale']);

            $this->entityManager->persist($accountEntity);
            $this->entityManager->flush();
            $isAccountOk = true;
        }

        if($userEntity && $isAccountOk) {
            $userAccountEntity
                ->setUser($userEntity)
                ->setAccount($accountEntity);

            $this->entityManager->persist($userAccountEntity);
            $this->entityManager->flush();
            $isUserAccountOk = true;
        }

        if($isAccountOk && $isUserAccountOk) {
            try {
                $this->entityManager->getConnection()->commit();
                return true;
            } catch (ConnectionException $error) {
                $notificationError->pushError('user', 'not possible to register user');
                $notificationError->setStatusCode(Response::HTTP_BAD_REQUEST);
                $this->entityManager->getConnection()->rollBack();
                return false;
            }
        }

        return false;
    }

    public function listAllByUser(NotificationError $notificationError, string $token)
    {
        $qb = $this->entityManager->createQueryBuilder();
        $userEntity = $this->userFinder->getByToken($token);

        $qb->select("a.id", "a.name", "a.sale")
            ->from(UserAccount::class, 'ua')
            ->leftJoin(Account::class, 'a', 'WITH', 'a.id = ua.account')
            ->where(
                $qb->expr()->eq('ua.user', ':idUser')
            )
            ->setParameter('idUser', $userEntity->getId());

        $q = $qb->getQuery();

        try {
            $account = $q->getArrayResult();
            if($account) {
                $account = array_map(function ($a) {
                    $a['sale'] = number_format($a['sale'], 2, ",", ".");
                    return $a;
                }, $account);
                return $account;
            }
            $notificationError->setStatusCode(Response::HTTP_NOT_FOUND);
            return $account;
        } catch (\Exception $error) {
            echo $error->getMessage();
            return false;
        }
    }

}