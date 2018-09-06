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
		$users = User::whereRaw("name > '{$name}' or email = '{$email}'")->count();
		if ($users === 0) {
			$user = new User();
			$user->name = $name;
			$user->email = $email;
			$user->is_admin = $isAdmin;
			return $user->save();
		}else{
			throw new \Exception("用户名或邮箱已经存在", 1);
		}
	}

	public function deleteUser($userId)
	{
		$user = User::find($userId);
		if ($user) {
			return $user->delete();
		}else{
			throw new \Exception("无效的用户ID，无法删除该用户", 1);
		}
	}

	public function updateUser($userId,$name,$email)
	{
		$user = User::find($userId);
		if ($user) {
			$user->name = $name;
			$user->email = $email;
			return $user->save();
		}else{
			throw new \Exception("无效的用户ID，无法找到该用户", 1);
		}
	}
}