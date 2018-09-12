<?php 
namespace AuthorityControl\Service;

use AuthorityControl\Model\User;
use AuthorityControl\Model\Role;
use AuthorityControl\Model\UserRole;

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
			//同步删除所有的用户角色关系
			UserRole::where('uid', '=', $userId)->delete();
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

	public function getUserRoleList($uid)
	{
		return User::find($uid)->roles;
	}

	/**
	 * 查询用户拥有的权限列表
	 * @return [type] [description]
	 */
	public function getUserAccessList($uid)
	{
		$userAccessList = [];
		$roleList = User::find($uid)->roles;
		foreach ($roleList as $role) {
			$accessList[] = Role::find($role['id'])->access;
		}
		if (!empty($accessList)) {
			$i = 0;
			foreach ($accessList as $key => $value) {
				foreach ($value as $k => $v) {
					if ($v['status'] == 1) {
						$userAccessList[$i]['urls'] = $v['urls'];
						$userAccessList[$i]['id'] = $v['id'];
						$userAccessList[$i]['title'] = $v['title'];
						$i++;
					}
				}
			}
		}
		return $userAccessList;
	}

	public function getUserInfo($uid)
	{
		return User::find($uid);
	}
}