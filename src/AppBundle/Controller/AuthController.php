<?php 
namespace AppBundle\Controller;
 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use AuthorityControl\Service\UserService;
use AuthorityControl\Service\RoleService;

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
            $response = ['code'=>0,'msg'=>$e->geeMessage()];
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
            $response = ['code'=>0,'msg'=>$e->geeMessage()];
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

}