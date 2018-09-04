<?php 
namespace AppBundle\Controller;
 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use AuthorityControl\Model\User;

class DefaultController
{
    public function indexAction(Request $request)
    {
    	$user = new User();
		$user->name = 'seven';
		$user->email = 'seven@to8to.com';
		$user->is_admin = 0;
		$user->status = 1;
		$user->save();
        return new Response("<h1>Hello world!</h1>");
    }
}