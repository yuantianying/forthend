<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('default', new Route('/', array(
    '_controller' => 'AppBundle\\Controller\\DefaultController::indexAction',
)));
$collection->add('auth', new Route('/auth', array(
    '_controller' => 'AppBundle\\Controller\\AuthController::indexAction',
)));
$collection->add('auth_user_list', new Route('/auth/userlist', array(
    '_controller' => 'AppBundle\\Controller\\AuthController::userListAction',
)));
$collection->add('auth_create_role', new Route('/auth/createrole', array(
    '_controller' => 'AppBundle\\Controller\\AuthController::createRoleAction',
)));
$collection->add('auth_update_role', new Route('/auth/updaterole', array(
    '_controller' => 'AppBundle\\Controller\\AuthController::updateRoleAction',
)));
$collection->add('auth_delete_role', new Route('/auth/deleterole', array(
    '_controller' => 'AppBundle\\Controller\\AuthController::deleteRoleAction',
)));
$collection->add('auth_role_list', new Route('/auth/rolelist', array(
    '_controller' => 'AppBundle\\Controller\\AuthController::roleListAction',
)));
return $collection;