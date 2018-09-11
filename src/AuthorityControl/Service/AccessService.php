<?php 
namespace AuthorityControl\Service;

use AuthorityControl\Model\Access;
use AuthorityControl\Model\Role;

class AccessService
{
	private $accessModel;

	function __construct()
	{
		$this->accessModel = new Access();
	}

	public function getAccessList()
	{
		return Access::all();
	}

	public function createAccess($title, $urls)
	{
		$access = Access::where('title', '=', $title)->count();
		if ($access == 0) {
			$access = $this->accessModel;
			$access->title = $title;
			$access->urls = $urls;
			return $access->save();
		}else{
			throw new \Exception("权限名称已经存在", 1);
		}
	}

	public function updateAccess($accessId,$title,$urls)
	{
		$access = Access::find($accessId);
		if ($access) {
			$access->title = $title;
			$access->urls = $urls;
			return $access->save();
		}else{
			throw new \Exception("无效的权限ID，无法找到该权限", 1);
		}
	}

	public function deleteAccess($accessId)
	{
		$access = Access::find($accessId);
		if ($access) {
			//同步删除所有角色权限关系
			RoleAccess::where('access_id', '=', $accessId)->delete();
			return $access->delete();
		}else{
			throw new \Exception("无效的权限ID，无法找到该权限", 1);
		}
	}
}