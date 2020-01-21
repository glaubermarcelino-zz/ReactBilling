<?php
/**
 * Created by PhpStorm.
 * User: giovane
 * Date: 1/14/20
 * Time: 11:37 AM
 */

namespace App\Controller\Api;

use App\Helpers\NotificationError;
use App\Services\Account\AccountService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Controller\Validate\AuthenticatedController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class Account
 * @package App\Controller\Api
 *
 * @Route("/api/v1/account")
 */
class Account extends AbstractController implements AuthenticatedController
{
    /**
     * @Route("", methods={"OPTIONS", "POST"})
     *
     * @param AccountService $accountService
     * @param Request $request
     * @return Response
     */
    public function register(Request $request, AccountService $accountService): Response
    {
        $notificationError = new NotificationError();

        $data = [
            'name' => $request->get('name'),
            'sale' => $request->get('sale'),
            'token' =>  $request->headers->get('Authorization')
        ];

        $isOK = $accountService->register($notificationError, $data);

        if($isOK) {
            $response = new Response(null, Response::HTTP_CREATED);
        } else {
            $response = new JsonResponse($notificationError->getErrors(), $notificationError->getSatusCode());
        }
        return $response;
    }

    /**
     * @Route("/user/all", methods={"OPTIONS", "GET"})
     *
     * @param AccountService $accountService
     * @param Request $request
     * @return Response
     */
    public function listAllByUser(Request $request, AccountService $accountService): Response
    {
        $notificationError = new NotificationError();
        $token = $request->headers->get('Authorization');
        $isData = $accountService->listAllByUser($notificationError, $token);

        if($isData) {
            $response = new JsonResponse($isData, Response::HTTP_OK);
        } else {
            $response = new JsonResponse($notificationError->getErrors(), $notificationError->getSatusCode());
        }
        return $response;
    }
}