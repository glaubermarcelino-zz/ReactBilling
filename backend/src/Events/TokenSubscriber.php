<?php
/**
 * Created by PhpStorm.
 * User: giovane
 * Date: 1/13/20
 * Time: 6:30 PM
 */

namespace App\Events;

use App\Services\Token\TokenService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Controller\Validate\AuthenticatedController;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class TokenSubscriber implements EventSubscriberInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function onKernelController(ControllerEvent $event)
    {
        $controller = $event->getController();

        if (!is_array($controller)) {
            return;
        }

        if ($controller[0] instanceof AuthenticatedController) {
            $token = $event->getRequest()->headers->get('Authorization');
            if(!$token) {
                throw new UnauthorizedHttpException("Does not contain token");
            } else {
                $tokenService = new TokenService($this->entityManager);
                if(!$tokenService->validate($token)){
                    throw new UnauthorizedHttpException("Invalid Token");
                }
            }
        }
    }

    public function onKernelException(ExceptionEvent $event)
    {
        $response = new JsonResponse();
        $exception = $event->getThrowable();

        if ($exception instanceof UnauthorizedHttpException) {
            $response->setContent(null);
            $response->setStatusCode(Response::HTTP_UNAUTHORIZED);

            $event->setResponse($response);
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
            KernelEvents::EXCEPTION => 'onKernelException'
        ];
    }
}