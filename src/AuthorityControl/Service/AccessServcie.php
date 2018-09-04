<?php 
namespace AuthorityControl\Service;

use AuthorityControl\Model\User;

class AccessService
{
	public function getAccessList()
	{
		return Access::all();
	}
}