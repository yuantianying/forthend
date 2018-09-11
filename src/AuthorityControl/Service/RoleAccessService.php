<?php 
namespace AuthorityControl\Service;

use AuthorityControl\Model\Role;
use AuthorityControl\Model\Access;
use AuthorityControl\Model\RoleAccess;

class RoleAccessService
{
	/**
	 * 给角色分配权限
	 * @param  int $roleId    角色Id
	 * @param  array $accessIds 权限Id数组
	 * @return bool            
	 */
	public function assignAccessToRole($roleId,$accessIds)
	{
		$role = Role::find($roleId);
		if (!$role) {
			throw new \Exception("无效的角色ID，无法找到该角色", 1);
		}
		if (empty($accessIds)) {
			throw new \Exception("分配的权限不能为空", 1);
		}
		foreach ($accessIds as $accessId) {
			$access = Access::find($accessId);
			if (!$access) {
				throw new \Exception("无效的权限Id:{$accessId}，无法找到该权限", 1);
			}else{
				$roleAccessModel = new RoleAccess();
				$roleAccessModel->role_id = $roleId;
				$roleAccessModel->access_id = $accessId;
				$roleAccessModel->save();
			}
		}
	}

	/**
	 * 根据角色Id查询该角色拥有的权限列表
	 * @param  [type] $roleId [description]
	 * @return [type]         [description]
	 */
	// public function getRoleAccessList($roleId)
	// {
	// 	return RoleAccess::where('role_id', '=', $roleId)->get();
	// }

	/**
	 * 取消角色拥有的权限
	 * @param  [type] $roleId [description]
	 * @return [type]         [description]
	 */
	public function deleteRoleAccess($roleAccessIds)
	{
		if (!is_array($roleAccessIds) || empty($roleAccessIds)) {
			throw new \Exception("角色权限不能为空", 1);
		}
		foreach ($roleAccessIds as $roleAccessId) {
			$roleAccess = RoleAccess::find($roleAccessId);
			if (!$roleAccess) {
				throw new \Exception("不存在的权限:{$roleAccessId}", 1);
			}else{
				$roleAccess->delete();
			}
		}
	}
}