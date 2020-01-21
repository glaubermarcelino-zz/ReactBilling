<?php
/**
 * Created by PhpStorm.
 * User: giovane
 * Date: 1/13/20
 * Time: 10:52 AM
 */

namespace App\Controller\Auth;

use App\Helpers\NotificationError;
use App\Services\Token\TokenService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class Token
 * @package App\Controller\Auth
 */
class Token extends AbstractController
{
    /**
     * @Route("/auth/v1/token", methods={"OPTIONS", "POST"})
     *
     * @param Request $request
     * @param TokenService $tokenService
     * @return Response
     */
    public function token(Request $request, TokenService $tokenService): Response
    {
        $notificationError = new NotificationError();

        $data = [
            'client_key' => (string) $request->get('client_key'),
            'client_secret' => (string) $request->get('client_secret'),
            'email' => (string) $request->get('email'),
            'password' => (string) $request->get('password')
        ];

        $token = $tokenService->accessToken($notificationError, $data);

        if($token) {
            $response = new JsonResponse($token, Response::HTTP_OK);
        } else {
            $response = new JsonResponse($notificationError->getErrors(), $notificationError->getSatusCode());
        }
        return $response;
    }
}