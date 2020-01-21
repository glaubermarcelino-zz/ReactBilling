<?php
/**
 * Created by PhpStorm.
 * User: giovane
 * Date: 1/13/20
 * Time: 12:23 PM
 */

namespace App\Controller\Api;


use App\Helpers\NotificationError;
use App\Services\User\UserService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Controller\Validate\AuthenticatedController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class User
 * @package App\Controller\Api
 *
 * @Route("/api/v1/user")
 */
class User extends AbstractController implements AuthenticatedController
{
    /**
     * @Route("", methods={"OPTIONS", "POST"})
     *
     * @param UserService $userService
     * @param Request $request
     * @return Response
     */
    public function register(Request $request, UserService $userService): Response
    {
        $notificationError = new NotificationError();

        $data = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'cpf' => $request->get('cpf'),
            'cell_phone' => $request->get('cell_phone')
        ];

        $isOK = $userService->register($notificationError, $data);

        if($isOK) {
            $response = new Response(null, Response::HTTP_CREATED);
        } else {
            $response = new JsonResponse($notificationError->getErrors(), $notificationError->getSatusCode());
        }
        return $response;
    }

    /**
     * @Route("/logged", methods={"OPTIONS", "GET"})
     *
     * @param UserService $userService
     * @param Request $request
     * @return Response
     */
    public function listOneLogged(Request $request, UserService $userService): Response
    {
        $notificationError = new NotificationError();
        $token = $request->headers->get('Authorization');
        $isData = $userService->lisOneLogged($notificationError, $token);

        if($isData) {
            $response = new JsonResponse($isData, Response::HTTP_OK);
        } else {
            $response = new JsonResponse($notificationError->getErrors(), $notificationError->getSatusCode());
        }
        return $response;
    }
}