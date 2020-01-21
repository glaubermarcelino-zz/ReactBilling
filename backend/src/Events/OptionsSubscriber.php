<?php
/**
 * Created by PhpStorm.
 * User: giovane
 * Date: 1/10/20
 * Time: 6:46 PM
 */

namespace App\Events;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class OptionsSubscriber implements EventSubscriberInterface
{
    public function onKernelController(ControllerEvent $event)
    {
        $request = $event->getRequest();
        if($request->getMethod() == "OPTIONS"){
            $event->setController(function (){
                $response = new Response();
                $response->setStatusCode(Response::HTTP_NO_CONTENT);
                return $response;
            });
        }
    }

    public static function getSubscribedEvents()
    {
        // TODO: Implement getSubscribedEvents() method.
        return array(
            KernelEvents::CONTROLLER => 'onKernelController'
        );
    }
}