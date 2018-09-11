<?php 
namespace AuthorityControl\Service;

use AuthorityControl\Model\User;
use AuthorityControl\Model\Role;
use AuthorityControl\Model\UserRole;

class UserRoleService
{

	/**
	 * 给用户分配角色
	 * @param  int $userId  用户id
	 * @param  int $roleIds 角色id
	 * @return           
	 */
	public function assignRoleToUser($userId,$roleIds)
	{
		$user = User::find($userId);
		if (!$user) {
			throw new \Exception("无效的用户ID", 1);
		}
		if (empty($roleIds)) {
			throw new \Exception("分配的角色不能为空", 1);
		}
		foreach ($roleIds as $roleId) {
			$role = Role::find($roleId);
			if (!$role) {
				throw new \Exception("无效的角色Id:{$roleId}", 1);
			}else{
				$userRoleModel = new UserRole();
				$userRoleModel->uid = $userId;
				$userRoleModel->role_id = $roleId;
				$userRoleModel->save();
			}
		}
	}

	/**
	 * 查询用户拥有的角色
	 * @param  int $userId 用户id
	 * @return          
	 */
	// public function getUserRoleList($userId)
	// {
	// 	return UserRole::where('uid', '=', $userId)->get();
	// }

	/**
	 * 删除用户的角色
	 * @param  array $userRoleIds 角色列表
	 * @return               
	 */
	public function deleteUserRole($userRoleIds)
	{
		if (!is_array($userRoleIds) || empty($userRoleIds)) {
			throw new \Exception("用户角色Id不能为空", 1);
		}
		foreach ($userRoleIds as $userRoleId) {
			$userRole = UserRole::find($userRoleId);
			if (!$userRole) {
				throw new \Exception("不存在的角色:{$userRoleId}", 1);
			}else{
				$userRole->delete();
			}
		}
	}
}