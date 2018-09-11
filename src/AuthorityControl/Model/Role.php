<?php
namespace AuthorityControl\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	/**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'role';
    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * 定义和权限的关系
     */
    public function access()
    {
        return $this->belongsToMany('AuthorityControl\Model\Access', 'role_access', 'role_id', 'access_id');
    }

    /*
    * 定义和用户的关联关系
    */
    public function users()
    {
        return $this->belongsToMany('AuthorityControl\Model\Role', 'user_role', 'uid', 'role_id');
    }
}