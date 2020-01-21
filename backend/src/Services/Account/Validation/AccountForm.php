<?php
/**
 * Created by PhpStorm.
 * User: giovane
 * Date: 1/14/20
 * Time: 12:03 PM
 */

namespace App\Services\Account\Validation;


use App\Helpers\NotificationError;
use Respect\Validation\Validator as v;
use Symfony\Component\HttpFoundation\Response;

abstract class AccountForm
{
    public static function validateRegister(NotificationError $notificationError, array $data)
    {
        $validator = v::allOf(
            v::key('name', v::stringType()->notEmpty()->setName('name'))
        );
        try {
            $validator->assert($data);
        } catch (\InvalidArgumentException $error) {
            $notificationError->pushError('validation', array_filter($error->findMessages([
                'notEmpty'    => 'The value must not be empty',
                'name'        => 'Please make sure you typed value a valid',
            ])));
            $notificationError->setStatusCode(Response::HTTP_BAD_REQUEST);
        }
        return $validator->validate($data);
    }
}