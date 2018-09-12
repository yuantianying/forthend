<?php
namespace AuthorityControl\Permission;

use AuthorityControl\Service\UserService;

class Verification
{
	/**
	 * 鉴权
	 */
	public static function check($uid,$path)
	{
		$userService = new UserService();
		$userInfo = $userService->getUserInfo($uid);
		$userInfo = json_decode($userInfo,true);
		if (empty($userInfo)) {
			return [
				'auth' => 0,
				'msg'  => '不存在该用户或者登陆已失效'
			];
		}
		//TODO::缓存用户的权限列表
		$userAccessList = $userService->getUserAccessList($uid);
		if (!empty($userAccessList)) {
			foreach ($userAccessList as $key => $value) {
				$accessList[] = $value['urls'];
			}
			if (in_array($path,$accessList)) {
				return [
					'auth' => 1,
					'msg'  => 'success' 
				];
			}else{
				return [
					'auth' => 0,
					'msg'  => '无访问权限' 
				];
			}
		}else{
			return [
				'auth' => 0,
				'msg'  => '无访问权限' 
			];
		}
		
	}
}