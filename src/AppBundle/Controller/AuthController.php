<?php 
namespace AppBundle\Controller;
 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use AuthorityControl\Service\UserService;
use AuthorityControl\Service\RoleService;
use AuthorityControl\Service\AccessService;
use AuthorityControl\Service\UserRoleService;
use AuthorityControl\Service\RoleAccessService;

class AuthController
{
	/**
	 * 获取角色列表
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
    public function roleListAction(Request $request)
    {
    	//TODO:分页查询
    	try {
    		$roleService = new RoleService();
	    	$roles = $roleService->getRoleList();
            $response = ['code'=>1,'data'=>$roles];
	    	
    	} catch (\Exception $e) {
            $response = ['code'=>0,'msg'=>$e->getMessage()];
    	}
        return new JsonResponse($response);
    }

    /**
     * 创建角色
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function createRoleAction(Request $request)
    {
        try {
            $name = $request->request->get('name');
            $roleService = new RoleService();
            $res = $roleService->createRole($name);
            $response = $res ? ['code'=>1,'msg'=>'success'] : ['code'=>0,'msg'=>'fail'];
        } catch (\Exception $e) {
            $response = ['code'=>-1,'msg'=>$e->getMessage()];
        }
        return new JsonResponse($response);
    }

    /**
     * 更新角色
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function updateRoleAction(Request $request)
    {
        try {
            $id      = $request->request->get('id');
            $name    = $request->request->get('name');
            $status  = $request->request->get('status');
            $roleService = new RoleService();
            $res = $roleService->updateRole($id,$name,$status);
            $response = $res ? ['code'=>1,'msg'=>'success'] : ['code'=>0,'msg'=>'fail'];
        } catch (\Exception $e) {
            $response = ['code'=>-1,'msg'=>$e->getMessage()];
        }
        return new JsonResponse($response);
    }
    /**
     * 删除角色
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function deleteRoleAction(Request $request)
    {
        try {
            $id = $request->request->get('id');
            $roleService = new RoleService();
            $res = $roleService->deleteRole($id);
            $response = $res ? ['code'=>1,'msg'=>'success'] : ['code'=>0,'msg'=>'fail'];
        } catch (\Exception $e) {
            $response = ['code'=>-1,'msg'=>$e->getMessage()];
        }
    	return new JsonResponse($response);
    }

    /**
     * 创建用户
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function createUserAction(Request $request)
    {
        try {
            $name    = $request->request->get('name');
            $email   = $request->request->get('email');
            $isAdmin = $request->request->get('is_admin');
            $userService = new UserService();
            $res = $userService->createUser($name,$email,$isAdmin);
            $response = $res ? ['code'=>1,'msg'=>'success'] : ['code'=>0,'msg'=>'fail'];
        } catch (\Exception $e) {
            $response = ['code'=>-1,'msg'=>$e->getMessage()];
        }
        return new JsonResponse($response);
    }

    /**
     * 获取用户列表
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function userListAction(Request $request)
    {
        //TODO:分页查询
        try {
            $userService = new UserService();
            $users = $userService->getUserList();
            $response = ['code'=>1,'data'=>$users];
        } catch (\Exception $e) {
            $response = ['code'=>0,'msg'=>$e->getMessage()];
        }
        return new JsonResponse($response);
    }

    /**
     * 根据ID删除用户
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function deleteUserAction(Request $request)
    {
        try {
            $id = $request->request->get('id');
            $userService = new UserService();
            $res = $userService->deleteUser($id);
            $response = $res ? ['code'=>1,'msg'=>'success'] : ['code'=>0,'msg'=>'fail'];
        } catch (\Exception $e) {
            $response = ['code'=>-1,'msg'=>$e->getMessage()];
        }
        return new JsonResponse($response);
    }

    /**
     * 更新用户信息
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function updateUserAction(Request $request)
    {
        try {
            $id      = $request->request->get('id');
            $name    = $request->request->get('name');
            $email   = $request->request->get('email');
            $userService = new UserService();
            $res = $userService->updateUser($id,$name,$email);
            $response = $res ? ['code'=>1,'msg'=>'success'] : ['code'=>0,'msg'=>'fail'];
        } catch (\Exception $e) {
            $response = ['code'=>-1,'msg'=>$e->getMessage()];
        }
        return new JsonResponse($response);
    }

    /**
     * 获取权限列表
     * @param Request $request [description]
     */
    public function AccessListAction(Request $request)
    {
        //TODO:分页查询
        try {
            $accessService = new AccessService();
            $access = $accessService->getAccessList();
            $response = ['code'=>1,'data'=>$access];
        } catch (\Exception $e) {
            $response = ['code'=>0,'msg'=>$e->getMessage()];
        }
        return new JsonResponse($response);
    }

    /**
     * 创建权限
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function createAccessAction(Request $request)
    {
        try {
            $title  = $request->request->get('title');
            $urls   = $request->request->get('urls');
            $accessService = new AccessService();
            $res = $accessService->createAccess($title,$urls);
            $response = $res ? ['code'=>1,'msg'=>'success'] : ['code'=>0,'msg'=>'fail'];
        } catch (\Exception $e) {
            $response = ['code'=>-1,'msg'=>$e->getMessage()];
        }
        return new JsonResponse($response);
    }

    /**
     * 根据ID删除权限
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function deleteAccessAction(Request $request)
    {
        try {
            $id = $request->request->get('id');
            $accessService = new AccessService();
            $res = $accessService->deleteAccess($id);
            $response = $res ? ['code'=>1,'msg'=>'success'] : ['code'=>0,'msg'=>'fail'];
        } catch (\Exception $e) {
            $response = ['code'=>-1,'msg'=>$e->getMessage()];
        }
        return new JsonResponse($response);
    }

    /**
     * 更新权限信息
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function updateAccessAction(Request $request)
    {
        try {
            $id     = $request->request->get('id');
            $title  = $request->request->get('title');
            $urls   = $request->request->get('urls');
            $accessService = new AccessService();
            $res = $accessService->updateAccess($id,$title,$urls);
            $response = $res ? ['code'=>1,'msg'=>'success'] : ['code'=>0,'msg'=>'fail'];
        } catch (\Exception $e) {
            $response = ['code'=>-1,'msg'=>$e->getMessage()];
        }
        return new JsonResponse($response);
    }

    /**
     * 给角色分配权限
     * @return [type] [description]
     */
    public function assignAccessToRoleAction(Request $request)
    {
        try {
            $roleId = $request->request->get('role_id');
            $accessIds = $request->request->get('access_ids');
            $accessIds = json_decode($accessIds,true);
            if (!empty($accessIds) && $roleId) {
                $roleAccessService = new RoleAccessService();
                $roleAccessService->assignAccessToRole($roleId,$accessIds);
                $response = ['code'=>1,'msg'=>'success'];   
            }else{
                $response = ['code'=>0,'msg'=>'参数不能为空'];
            }
        } catch (\Exception $e) {
            $response = ['code'=>-1,'msg'=>$e->getMessage()];
        }
        return new JsonResponse($response);
    }

    /**
     * 根据角色Id查询权限
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function roleAccessListAction(Request $request)
    {
        try {
            $roleId = intval($request->query->get('role_id'));
            $roleService = new RoleService();
            $accessList = $roleService->getRoleAccessList($roleId);
            $response = ['code'=>1,'data'=>$accessList];
        } catch (\Exception $e) {
            $response = ['code'=>-1,'msg'=>$e->getMessage()];
        }
        return new JsonResponse($response);
    }

    /**
     * 禁用角色拥有的权限
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function deleteRoleAccessAction(Request $request)
    {
        try {
            $roleAccessIds = $request->request->get('role_access_ids');
            $roleAccessIds = json_decode($roleAccessIds,true);
            if (empty($roleAccessIds)) {
                $response = ['code'=>0,'msg'=>'参数不能为空'];
            }else{
                $roleAccessService = new RoleAccessService();
                $roleAccessService->deleteRoleAccess($roleAccessIds);
                $response = ['code'=>1,'data'=>'success'];
            }
        } catch (\Exception $e) {
            $response = ['code'=>-1,'msg'=>$e->getMessage()];
        }
        return new JsonResponse($response);
    }

    /**
     * 给用户分配角色
     * @return [type] [description]
     */
    public function assignRoleToUserAction(Request $request)
    {
        try {
            $userId = $request->request->get('uid');
            $roleIds = $request->request->get('role_ids');
            $roleIds = json_decode($roleIds,true);
            if (!empty($roleIds) && $userId) {
                $userRoleService = new UserRoleService();
                $userRoleService->assignRoleToUser($userId,$roleIds);
                $response = ['code'=>1,'msg'=>'success'];   
            }else{
                $response = ['code'=>0,'msg'=>'参数不能为空'];
            }
        } catch (\Exception $e) {
            $response = ['code'=>-1,'msg'=>$e->getMessage()];
        }
        return new JsonResponse($response);
    }

    /**
     * 根据用户Id查询用户拥有的角色列表
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function userRoleListAction(Request $request)
    {
        try {
            $userId = intval($request->query->get('uid'));
            $userService = new UserService();
            $roleList = $userService->getUserRoleList($userId);
            $response = ['code'=>1,'data'=>$roleList];
        } catch (\Exception $e) {
            $response = ['code'=>-1,'msg'=>$e->getMessage()];
        }
        return new JsonResponse($response);
    }

    /**
     * 禁用用户拥有的角色
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function deleteUserRoleAction(Request $request)
    {
        try {
            $userRoleIds = $request->request->get('user_role_ids');
            $userRoleIds = json_decode($userRoleIds,true);
            if (empty($userRoleIds)) {
                $response = ['code'=>0,'msg'=>'参数不能为空'];
            }else{
                $userRoleService = new UserRoleService();
                $userRoleService->deleteUserRole($userRoleIds);
                $response = ['code'=>1,'data'=>'success'];
            }
        } catch (\Exception $e) {
            $response = ['code'=>-1,'msg'=>$e->getMessage()];
        }
        return new JsonResponse($response);
    }


    /**
     * 获取用户拥有的权限列表
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getUserAccessListAction(Request $request)
    {
        try {
            $userId = intval($request->query->get('uid'));
            $userService = new UserService();
            $accessList = $userService->getUserAccessList($userId);
            $response = ['code'=>1,'data'=>$accessList];
        } catch (\Exception $e) {
            $response = ['code'=>-1,'msg'=>$e->getMessage()];
        }
        return new JsonResponse($response);
    }
}