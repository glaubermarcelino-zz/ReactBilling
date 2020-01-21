<?php
/**
 * Created by PhpStorm.
 * User: giovane
 * Date: 1/13/20
 * Time: 11:09 AM
 */

namespace App\Helpers;

/**
 * Class PasswordManager
 * @package App\Helpers
 */
class PasswordManager
{
    private $password;
    private const LEARNS = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';

    public function verifyPassword($hash, string $password)
    {
        return password_verify($password, $hash);
    }

    public function encryotPassword(string $password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function generatePassword(int $length): string {
        $pass = [];
        $learnsLength = strlen(self::LEARNS) - 1;
        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, $learnsLength);
            $pass[] = self::LEARNS[$index];
        }
        $this->password = implode($pass);
        return $this->password;
    }

    public function getHashPassword()
    {
        return password_hash($this->password, PASSWORD_DEFAULT);
    }
}