<?php 
namespace AuthorityControl\Service;

use AuthorityControl\Model\User;

class UserService
{
	public function getUserList()
	{
		return User::all();
	}

	public function createUser($name,$email,$isAdmin)
	{
		$user = new User();
		$user->name = $name;
		$user->email = $email;
		$user->is_admin = $isAdmin;
		$user->save();
	}
}