<?php
/**
 * Site: www.forthend.com
 * User: seven.yuan<seven.yuan@to8to.corp.com>
 * Date: 2018/8/28
 */
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\EventDispatcher\EventDispatcher;
use AppBundle\Event\RequestEvent;
 
class AppKernel
{
    private $dispatcher;
    protected $matcher;
    protected $controllerResolver;
    protected $argumentResolver;
 
    public function __construct(EventDispatcher $dispatcher, UrlMatcher $matcher, ControllerResolver $controllerResolver, ArgumentResolver $argumentResolver)
    {
        $this->dispatcher = $dispatcher;
        $this->matcher = $matcher;
        $this->controllerResolver = $controllerResolver;
        $this->argumentResolver = $argumentResolver;
    }
 
    public function handle(Request $request)
    {

        $this->matcher->getContext()->fromRequest($request);
        try {
            $request->attributes->add($this->matcher->match($request->getPathInfo()));
            $controller = $this->controllerResolver->getController($request);
            $arguments = $this->argumentResolver->getArguments($request, $controller);
            $response = call_user_func_array($controller, $arguments);
        } catch (ResourceNotFoundException $e) {
            $response =  new Response('Not Found', 404);
        } catch (\Exception $e) {
            $response =  new Response('An error occurred', 500);
        }

        // 派遣事件，监听请求进行权限校验
        $this->dispatcher->dispatch('authorityControl', new RequestEvent($response,$request));

        return $response;
    }
}