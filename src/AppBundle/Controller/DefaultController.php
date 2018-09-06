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
        return new Response("<h1>Hello world!</h1>");
    }
}