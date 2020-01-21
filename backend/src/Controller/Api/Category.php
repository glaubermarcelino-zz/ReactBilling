<?php
/**
 * Created by PhpStorm.
 * User: giovane
 * Date: 1/16/20
 * Time: 3:35 PM
 */

namespace App\Controller\Api;


use App\Helpers\NotificationError;
use App\Services\Category\CategoryService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\Validate\AuthenticatedController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class Category
 * @package App\Controller\Api
 *
 * @Route("/api/v1/category")
 */
class Category extends AbstractController implements AuthenticatedController
{
    /**
     * @Route("/{idType}", methods={"OPTIONS", "GET"})
     *
     * @param CategoryService $categoryService
     * @param int $idType
     * @return Response
     */
    public function listAllByType(int $idType, CategoryService $categoryService): Response
    {
        $notificationError = new NotificationError();

        $isData = $categoryService->listAllByType($notificationError, $idType);

        if($isData) {
            $response = new JsonResponse($isData, Response::HTTP_OK);
        } else {
            $response = new JsonResponse($notificationError->getErrors(), $notificationError->getSatusCode());
        }
        return $response;
    }
}