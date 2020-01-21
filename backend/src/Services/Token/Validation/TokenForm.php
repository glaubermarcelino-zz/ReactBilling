<?php
/**
 * Created by PhpStorm.
 * User: giovane
 * Date: 1/13/20
 * Time: 10:55 AM
 */

namespace App\Services\Token\Validation;

use App\Helpers\NotificationError;
use Respect\Validation\Validator as v;
use Symfony\Component\HttpFoundation\Response;

abstract class TokenForm
{
    public static function validateRegister(NotificationError $notificationError, array $data): ?bool
    {
        $validator = v::allOf(
            v::key('client_key', v::stringType()->notEmpty()->setName('client_key')),
            v::key('client_secret', v::stringType()->notEmpty()->setName('client_secret')),
            v::key('email', v::stringType()->notEmpty()->setName('email')),
            v::key('password', v::stringType()->notEmpty()->setName('password'))
        );
        try {
            $validator->assert($data);
        } catch (\InvalidArgumentException $error) {
            $notificationError->pushError('validation', array_filter($error->findMessages([
                'notEmpty'         => 'The value must not be empty',
                'client_key'       => 'Please make sure you typed value a valid',
                'client_secret'    => 'Please make sure you typed value a valid',
                'email'            => 'Please make sure you typed value a valid',
                'password'         => 'Please make sure you typed value a valid'
            ])));
            $notificationError->setStatusCode(Response::HTTP_BAD_REQUEST);
        }
        return $validator->validate($data);
    }
}