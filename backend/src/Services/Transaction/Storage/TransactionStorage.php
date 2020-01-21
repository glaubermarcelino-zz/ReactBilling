<?php
/**
 * Created by PhpStorm.
 * User: giovane
 * Date: 1/15/20
 * Time: 5:18 PM
 */

namespace App\Services\Transaction\Storage;


use App\Entity\Account;
use App\Entity\Transition;
use App\Entity\User;
use App\Entity\UserAccount;
use App\Helpers\UserFinder;
use App\Entity\TransitionType;
use App\Entity\TransitionCategory;
use App\Helpers\NotificationError;
use Doctrine\DBAL\ConnectionException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class TransactionStorage
{
    private $userFinder;
    private $entityManager;

    private const REVENUE = 1;
    private const EXPENSE = 2;
    private const INVEST = 3;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->userFinder = new UserFinder($this->entityManager);
    }

    public function register(NotificationError  $notificationError, array $data)
    {
        $data['value'] = str_replace('.', '', $data['value']);
        $data['value'] = str_replace(',', '.', $data['value']);

        $isTransactionOK = false;
        $transactionEntity = new Transition();

        $this->entityManager->getConnection()->beginTransaction();

        /** @var Account $accountEntity */
        $accountEntity = $this->entityManager
            ->getRepository(Account::class)
            ->findOneBy(['id' => $data['account']]);

        /** @var TransitionType $typeEntity */
        $typeEntity = $this->entityManager
            ->getRepository(TransitionType::class)
            ->findOneBy(['id' => $data['type']]);

        /** @var TransitionCategory $categoryEntity */
        $categoryEntity = $this->entityManager
            ->getRepository(TransitionCategory::class)
            ->findOneBy(['id' => $data['category']]);

        if($typeEntity->getId() == self::REVENUE) {
            $accountEntity->setSale(
                $accountEntity->getSale() + $data['value']
            );
        }

        if($typeEntity->getId() == self::EXPENSE) {
            $accountEntity->setSale(
                $accountEntity->getSale() - $data['value']
            );
        }

        if($accountEntity && $typeEntity && $categoryEntity) {

            $transactionEntity
                ->setAccount($accountEntity)
                ->setType($typeEntity)
                ->setCategory($categoryEntity)
                ->setName($data['name'])
                ->setValue($data['value'])
                ->setFixed($data['fixed'])
                ->setNote($data['note'])
                ->setTag($data['tag'])
                ->setDate(new \DateTime($data['date']));

            $this->entityManager->persist($transactionEntity);
            $this->entityManager->flush();
            $isTransactionOK = true;
        }

        if($isTransactionOK) {
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

    public function listAllDashboard(NotificationError $notificationError, string $month, string $token)
    {
        /** @var User $userEntity */
        $userEntity = $this->userFinder->getByToken($token);

        $data = new \DateTime($month);
        $totalRevenue = $totalExpense = 0;

        $qb = $this->entityManager->createQueryBuilder();

        $qb->select('tt.id as type', 't.value')
            ->from(Transition::class, 't')
            ->leftJoin(Account::class, 'a', 'WITH', 't.account = a.id')
            ->leftJoin(UserAccount::class, 'ua', 'WITH', 'ua.account = a.id')
            ->leftJoin(TransitionType::class, 'tt', 'WITH', 't.type = tt.id')
            ->where('MONTH(t.date) = MONTH(:date)')
            ->andWhere(
                $qb->expr()->eq('ua.user', ':user')
            )
            ->setParameter('user', $userEntity->getId())
            ->setParameter('date', $data->format('Y-m-d'));

        $q = $qb->getQuery();

        try {
            $transactions = $q->getArrayResult();

            if($transactions) {
                foreach ( $transactions as $transaction) {
                    if($transaction['type'] == self::REVENUE) {
                        $totalRevenue += $transaction['value'];
                    }
                    if($transaction['type'] == self::EXPENSE) {
                        $totalExpense += $transaction['value'];
                    }
                }

                $totalRevenue = number_format($totalRevenue, 2, ",", ".");
                $totalExpense = number_format($totalExpense, 2, ",", ".");

                return [
                    'revenue' => $totalRevenue,
                    'expense' => $totalExpense
                ];
            }

            $notificationError->setStatusCode(Response::HTTP_NOT_FOUND);
            return $transactions;
        } catch (\Exception $error) {
            echo $error->getMessage();
            return false;
        }
    }

    public function listAllWithFilter(NotificationError $notificationError, array $data)
    {
        /** @var User $userEntity */
        $userEntity = $this->userFinder->getByToken($data['token']);

        $date = new \DateTime($data['date']);

        $qb = $this->entityManager->createQueryBuilder();

        $qbn = $qb->select('t.id', 'a.name as account', 'tt.type', 'tc.category', 't.value', 't.date', 't.fixed', 't.note', 't.name')
            ->from(Transition::class, 't')
            ->leftJoin(Account::class, 'a', 'WITH', 't.account = a.id')
            ->leftJoin(UserAccount::class, 'ua', 'WITH', 'ua.account = a.id')
            ->leftJoin(TransitionType::class, 'tt', 'WITH', 't.type = tt.id')
            ->leftJoin(TransitionCategory::class, 'tc', 'WITH', 't.category = tc.id')
            ->where('MONTH(t.date) = MONTH(:date)')
            ->andWhere(
                $qb->expr()->eq('ua.user', ':user')
            );

        if($data['type']) {
            $qbn
                ->andWhere(
                    $qb->expr()->eq('tt.id', ':type')
                )
                ->setParameter('type', $data['type']);
        }

        if($data['category']) {
            $qbn
                ->andWhere(
                    $qb->expr()->eq('tc.id', ':category')
                )
                ->setParameter('category', $data['category']);
        }

        $qbn
            ->orderBy('t.date', 'ASC')
            ->setParameter('user', $userEntity->getId())
            ->setParameter('date', $date->format('Y-m-d'));

        $q = $qb->getQuery();

        try {
            $transaction = $q->getArrayResult();
            if ($transaction) {
                $transaction = array_map(function ($t) {
                    $t['date'] =  date('d/m/Y', $t['date']->getTimestamp());
                    $t['value'] = number_format($t['value'], 2, ",", ".");
                    return $t;
                }, $transaction);
                return $transaction;
            }
            $notificationError->setStatusCode(Response::HTTP_NOT_FOUND);
            return $transaction;
        } catch (\Exception $error) {
            echo $error->getMessage();
            return false;
        }
    }
}