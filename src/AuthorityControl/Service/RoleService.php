<?php 
namespace AuthorityControl\Service;

use AuthorityControl\Model\Role;
use AuthorityControl\Model\UserRole;
use AuthorityControl\Model\RoleAccess;

class RoleService
{
	private $roleModel;

	function __construct()
	{
		$this->roleModel = new Role();
	}

	public function getRoleList()
	{
		return Role::all();
	}

	public function createRole($name)
	{
		$roles = Role::where('name', '=', $name)->count();
		if ($roles == 0) {
			$role = $this->roleModel;
			$role->name = $name;
			return $role->save();
		}else{
			throw new \Exception("角色名称已经存在", 1);
		}
	}

	public function updateRole($roleId,$name,$status)
	{
		$role = Role::find($roleId);
		if ($role) {
			$role->name = $name;
			$role->status = $status;
			return $role->save();
		}else{
			throw new \Exception("无效的角色ID，无法找到该角色", 1);
		}
	}

	public function deleteRole($roleId)
	{
		$role = Role::find($roleId);
		if ($role) {
			//同步删除所有的用户角色关系以及权限角色关系
			UserRole::where('role_id', '=', $roleId)->delete();
			RoleAccess::where('role_id', '=', $roleId)->delete();
			return $role->delete();
		}else{
			throw new \Exception("无效的角色ID，无法找到该角色", 1);
		}
	}

	public function getRoleAccessList($roleId)
	{
		return Role::find($roleId)->access;
	}
}