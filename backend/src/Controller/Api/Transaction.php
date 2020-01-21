<?php
/**
 * Created by PhpStorm.
 * User: giovane
 * Date: 1/15/20
 * Time: 4:12 PM
 */

namespace App\Controller\Api;

use App\Helpers\NotificationError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\Transaction\TransactionService;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Controller\Validate\AuthenticatedController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class Account
 * @package App\Controller\Api
 *
 * @Route("/api/v1/transaction")
 */
class Transaction extends AbstractController implements AuthenticatedController
{
    /**
     * @Route("", methods={"OPTIONS", "POST"})
     *
     * @param TransactionService $transactionService
     * @param Request $request
     * @return Response
     */
    public function register(Request $request, TransactionService $transactionService): Response
    {
        $notificationError = new NotificationError();

        $data = [
            'account' => (int) $request->get('account'),
            'type' => (int) $request->get('type'),
            'category' => (int) $request->get('category'),
            'name' => (string) $request->get('name'),
            'value' => (string) $request->get('value'),
            'date' => $request->get('date'),
            'fixed' =>  (boolean) $request->get('fixed'),
            'note' =>  (string) $request->get('note'),
            'tag' =>  (string) $request->get('tag')
        ];

        $isOK = $transactionService->register($notificationError, $data);

        if($isOK) {
            $response = new Response(null, Response::HTTP_CREATED);
        } else {
            $response = new JsonResponse($notificationError->getErrors(), $notificationError->getSatusCode());
        }
        return $response;
    }

    /**
     * @Route("/dashboard", methods={"OPTIONS", "POST"})
     *
     * @param TransactionService $transactionService
     * @param Request $request
     * @return Response
     */
    public function listAllByDashboard(Request $request, TransactionService $transactionService): Response
    {
        $notificationError = new NotificationError();

        $month = $request->get('date');
        $token = $request->headers->get('Authorization');

        $isData = $transactionService->listAllByDashboard($notificationError, $month, $token);

        if($isData) {
            $response = new JsonResponse($isData, Response::HTTP_OK);
        } else {
            $response = new JsonResponse($notificationError->getErrors(), $notificationError->getSatusCode());
        }
        return $response;
    }

    /**
     * @Route("/filter", methods={"OPTIONS", "POST"})
     *
     * @param TransactionService $transactionService
     * @param Request $request
     * @return Response
     */
    public function listAllWithFilter(Request $request, TransactionService $transactionService): Response
    {
        $notificationError = new NotificationError();

        $data = [
            'date' => $request->get('date'),
            'type' => $request->get('type'),
            'category' => $request->get('category'),

            'token' => $request->headers->get('Authorization')
        ];

        $isData = $transactionService->listAllWithFilter($notificationError, $data);

        if($isData) {
            $response = new JsonResponse($isData, Response::HTTP_OK);
        } else {
            $response = new JsonResponse($notificationError->getErrors(), $notificationError->getSatusCode());
        }
        return $response;
    }
}