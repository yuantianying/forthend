<?php 
require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;
use Illuminate\Database\Capsule\Manager as Capsule;

$request = Request::createFromGlobals();
$routes = include __DIR__.'/../app/config/routing.php';

$context = new Routing\RequestContext();
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

$controllerResolver = new HttpKernel\Controller\ControllerResolver();
$argumentResolver = new HttpKernel\Controller\ArgumentResolver();

$capsule = new Capsule;
$capsule->addConnection(require __DIR__.'/../app/config/database.php');
$capsule->bootEloquent();

$framework = new AppKernel($matcher, $controllerResolver, $argumentResolver);
$response = $framework->handle($request);
$response->send();