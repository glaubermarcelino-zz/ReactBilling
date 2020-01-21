<?php
/**
 * Created by PhpStorm.
 * User: giovane
 * Date: 1/13/20
 * Time: 12:24 PM
 */

namespace App\Services\User\Storage;


use App\Entity\User;
use App\Entity\Login;
use App\Entity\LoginUser;
use App\Helpers\PasswordManager;
use App\Helpers\NotificationError;
use App\Services\Token\Storage\TokenStorage;
use Doctrine\DBAL\ConnectionException;
use Doctrine\ORM\EntityManagerInterface;
use Firebase\JWT\JWT;
use Symfony\Component\HttpFoundation\Response;

class UserStorage
{
    private $entityManager;

    private const SALT= 'c98c3fece0b458e39eedaf7412123a7e';

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function register(NotificationError $notificationError, PasswordManager $passwordManager, array $data)
    {
        $isLoginOk = $isLoginUserOk = false;

        $userEntity = new User();
        $loginEntity = new Login();
        $loginUserEntity = new LoginUser();

        $this->entityManager->getConnection()->beginTransaction();

        $userEntity
            ->setName($data['name'])
            ->setEmail($data['email'])
            ->setCpf($data['cpf'])
            ->setCellPhone($data['cell_phone']);

        $this->entityManager->persist($userEntity);
        $this->entityManager->flush();
        $isUserOk = true;

        if($isUserOk) {
            $loginEntity
                ->setEmail($data['email'])
                ->setPassword($passwordManager->encryotPassword($data['password']));

            $this->entityManager->persist($loginEntity);
            $this->entityManager->flush();
            $isLoginOk = true;
        }

        if($isUserOk && $isLoginOk) {
            $loginUserEntity
                ->setUser($userEntity)
                ->setLogin($loginEntity);

            $this->entityManager->persist($loginUserEntity);
            $this->entityManager->flush();
            $isLoginUserOk = true;
        }

        if($isUserOk && $isLoginOk && $isLoginUserOk) {
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

    public function lisOneLogged(NotificationError $notificationError, ?string $token)
    {
        $decoded = JWT::decode($token, TokenStorage::SALT, ['HS256']);

        $qb = $this->entityManager->createQueryBuilder();

        $qb->select("u.name", "u.email", "u.cpf", "u.cell_phone", "u.date_created")
            ->from(User::class, 'u')
            ->where(
                $qb->expr()->eq('u.email', ':email')
            )
            ->setParameter('email', $decoded->message);

        $q = $qb->getQuery();

        try {
            $user = $q->getArrayResult();
            if($user) {
                $user[0]['date_created'] = date('d-m-Y H:i', $user[0]['date_created']->getTimestamp());
                return $user[0];
            }
            $notificationError->setStatusCode(Response::HTTP_NOT_FOUND);
            return $user;
        } catch (\Exception $error) {
            echo $error->getMessage();
            return false;
        }
    }
}