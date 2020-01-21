<?php
/**
 * Created by PhpStorm.
 * User: giovane
 * Date: 1/14/20
 * Time: 3:49 PM
 */

namespace App\Helpers;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserFinder
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getByToken(string $token)
    {
        $idUser = json_decode(base64_decode(explode(".", $token)[1]), true)['id_user'];
        /** @var User $userRepository */
        $userRepository = $this->entityManager->getRepository(User::class)->findOneBy(['id' => $idUser]);
        return $userRepository;
    }
}