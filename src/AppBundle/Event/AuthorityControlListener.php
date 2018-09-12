<?php 
namespace AppBundle\Event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
//引入权限校验的类
use AuthorityControl\Permission\Verification;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthorityControlListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array('authorityControl' => 'onAuthorityControl');
    }

    public function onAuthorityControl(RequestEvent $event)
    {
    	$request = $event->getRequest();
    	$response = $event->getResponse();
    	$path = $request->getPathInfo();
        $uid = $request->headers->get('uid');
        $authRes = Verification::check($uid,$path);
        if ($authRes['auth'] == 0) {
        	$response->setContent(new JsonResponse($authRes));
        }
    }
}