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
$collection->add('auth_user_list', new Route('/auth/userlist', array(
    '_controller' => 'AppBundle\\Controller\\AuthController::userListAction',
)));
$collection->add('auth_create_user', new Route('/auth/createuser', array(
    '_controller' => 'AppBundle\\Controller\\AuthController::createUserAction',
)));
$collection->add('auth_delete_user', new Route('/auth/deleteuser', array(
    '_controller' => 'AppBundle\\Controller\\AuthController::deleteUserAction',
)));
$collection->add('auth_update_user', new Route('/auth/updateuser', array(
    '_controller' => 'AppBundle\\Controller\\AuthController::updateUserAction',
)));
$collection->add('auth_access_list', new Route('/auth/accesslist', array(
    '_controller' => 'AppBundle\\Controller\\AuthController::accessListAction',
)));
$collection->add('auth_create_access', new Route('/auth/createaccess', array(
    '_controller' => 'AppBundle\\Controller\\AuthController::createAccessAction',
)));
$collection->add('auth_delete_access', new Route('/auth/deleteaccess', array(
    '_controller' => 'AppBundle\\Controller\\AuthController::deleteAccessAction',
)));
$collection->add('auth_update_access', new Route('/auth/updateaccess', array(
    '_controller' => 'AppBundle\\Controller\\AuthController::updateAccessAction',
)));
$collection->add('auth_assign_access_to_role', new Route('/auth/assignaccess', array(
    '_controller' => 'AppBundle\\Controller\\AuthController::assignAccessToRoleAction',
)));
$collection->add('auth_role_access_list', new Route('/auth/role/accesslist', array(
    '_controller' => 'AppBundle\\Controller\\AuthController::roleAccessListAction',
)));
$collection->add('auth_role_delete_access', new Route('/auth/role/deleteaccess', array(
    '_controller' => 'AppBundle\\Controller\\AuthController::deleteRoleAccessAction',
)));
$collection->add('auth_assign_role_to_user', new Route('/auth/assignrole', array(
    '_controller' => 'AppBundle\\Controller\\AuthController::assignRoleToUserAction',
)));
$collection->add('auth_user_role_list', new Route('/auth/user/rolelist', array(
    '_controller' => 'AppBundle\\Controller\\AuthController::userRoleListAction',
)));
$collection->add('auth_user_delete_role', new Route('/auth/user/deleterole', array(
    '_controller' => 'AppBundle\\Controller\\AuthController::deleteUserRoleAction',
)));
$collection->add('auth_user_access_list_role', new Route('/auth/user/accesslist', array(
    '_controller' => 'AppBundle\\Controller\\AuthController::getUserAccessListAction',
)));

return $collection;