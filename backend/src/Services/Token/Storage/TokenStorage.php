<?php
/**
 * Created by PhpStorm.
 * User: giovane
 * Date: 1/13/20
 * Time: 10:54 AM
 */

namespace App\Services\Token\Storage;


use App\Entity\User;
use App\Entity\Token;
use App\Entity\Login;
use Doctrine\DBAL\ConnectionException;
use Firebase\JWT\JWT;
use App\Entity\AppClient;
use App\Helpers\PasswordManager;
use App\Helpers\NotificationError;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class TokenStorage
{
    private $entityManager;
    private const EXPIRES_TOKEN = 3600;
    private const EXPIRES_REFRESH = 10800;
    private const SALT= 'c98c3fece0b458e39eedaf7412123a7e';

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    private function generateToken(string $type, array $payload, string $alg = 'HS256')
    {
        $payload['exp'] = time() + ($type === 'token' ? self::EXPIRES_TOKEN : self::EXPIRES_REFRESH);
        return JWT::encode($payload, self::SALT, $alg);
    }

    public function accessToken(NotificationError $notificationError, array $data)
    {
        $passwordManager = new PasswordManager();

        /** @var AppClient $appClientRepository */
        $appClientRepository = $this->entityManager
            ->getRepository(AppClient::class)
            ->findOneBy(['app_key' => $data['client_key'], 'app_client' => $data['client_secret']]);

        if(!$appClientRepository) {
            $notificationError->setStatusCode(Response::HTTP_BAD_REQUEST);
            $notificationError->pushError('app', 'invalid credentials');
            return false;
        }

        /** @var Login $loginRepository */
        $loginRepository =  $this->entityManager
            ->getRepository(Login::class)
            ->findOneBy(['email' => $data['email']]);

        if(!$loginRepository || !$passwordManager->verifyPassword($loginRepository->getPassword(), $data['password'])) {
            $notificationError->setStatusCode(Response::HTTP_UNAUTHORIZED);
            $notificationError->pushError('login', 'invalid email or password');
            return false;
        }

        /** @var User $userRepository */
        $userRepository = $this->entityManager
            ->getRepository(User::class)
            ->findOneBy(['email' => $data['email']]);

        $payload = [
            'id_user' => $userRepository->getId(),
            'message' => $loginRepository->getEmail()
        ];

        $token = $this->generateToken('token', $payload);
        $refreshToken = $this->generateToken('refresh', $payload, 'HS384');

        try {
            $expiresIn = new \DateTime("now", new \DateTimeZone("UTC"));
            $expiresIn->add(new \DateInterval("PT". self::EXPIRES_TOKEN ."S"));
        } catch (\Exception $e) {
            $expiresIn = null;
        }

        $this->entityManager->getConnection()->beginTransaction();

        $tokenEntity = new Token();

        $tokenEntity
            ->setAccessToken($token)
            ->setRefreshToken($refreshToken)
            ->setExpiresIn($expiresIn)
            ->setLogin($loginRepository)
            ->setAppClient($appClientRepository);

        $this->entityManager->persist($tokenEntity);
        $this->entityManager->flush();

        try {
            $this->entityManager->getConnection()->commit();
            $response = [
                'token' => $token,
                'refresh_token' => $refreshToken,
                'expires_in' => self::EXPIRES_TOKEN
            ];
            return $response;
        } catch (ConnectionException $error) {
            $notificationError->pushError('token', 'not possible to create token');
            $notificationError->setStatusCode(Response::HTTP_BAD_REQUEST);
            $this->entityManager->getConnection()->rollBack();
            return false;
        }
    }
}