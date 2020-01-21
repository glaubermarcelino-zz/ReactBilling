<?php
/**
 * Created by PhpStorm.
 * User: giovane
 * Date: 1/15/20
 * Time: 5:19 PM
 */

namespace App\Services\Transaction\Validation;

use App\Helpers\NotificationError;
use Respect\Validation\Validator as v;
use Symfony\Component\HttpFoundation\Response;

abstract class TransactionForm
{
    public static function validateRegister(NotificationError $notificationError, array $data)
    {
        $validator = v::allOf(
            v::key('account', v::intType()->notEmpty()->setName('account')),
            v::key('type', v::intType()->notEmpty()->setName('type')),
            v::key('category', v::intType()->notEmpty()->setName('category')),
            v::key('name', v::stringType()->notEmpty()->setName('name')),
            v::key('value', v::stringType()->notEmpty()->setName('value')),
            v::key('date', v::stringType()->notEmpty()->setName('date'))
        );
        try {
            $validator->assert($data);
        } catch (\InvalidArgumentException $error) {
            $notificationError->pushError('validation', array_filter($error->findMessages([
                'notEmpty'      => 'The value must not be empty',
                'account'       => 'Please make sure you typed value a valid',
                'type'          => 'Please make sure you typed value a valid',
                'category'      => 'Please make sure you typed value a valid',
                'name'          => 'Please make sure you typed value a valid',
                'value'         => 'Please make sure you typed value a valid',
                'date'          => 'Please make sure you typed value a valid',
            ])));
            $notificationError->setStatusCode(Response::HTTP_BAD_REQUEST);
        }
        return $validator->validate($data);
    }
}