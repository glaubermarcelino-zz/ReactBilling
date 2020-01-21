<?php
/**
 * Created by PhpStorm.
 * User: giovane
 * Date: 1/13/20
 * Time: 12:25 PM
 */

namespace App\Services\User\Validation;

use App\Helpers\NotificationError;
use Respect\Validation\Validator as v;
use Symfony\Component\HttpFoundation\Response;

abstract class UserForm
{

    public static function validateRegister(NotificationError $notificationError, array $data)
    {
        $validator = v::allOf(
            v::key('name', v::stringType()->notEmpty()->setName('name')),
            v::key('email', v::stringType()->notEmpty()->setName('email')),
            v::key('cpf', v::stringType()->notEmpty()->setName('cpf'))
        );
        try {
            $validator->assert($data);
        } catch (\InvalidArgumentException $error) {
            $notificationError->pushError('validation', array_filter($error->findMessages([
                'notEmpty'    => 'The value must not be empty',
                'name'        => 'Please make sure you typed value a valid',
                'email'       => 'Please make sure you typed value a valid',
                'cpf'         => 'Please make sure you typed value a valid'
            ])));
            $notificationError->setStatusCode(Response::HTTP_BAD_REQUEST);
        }
        return $validator->validate($data);
    }
}