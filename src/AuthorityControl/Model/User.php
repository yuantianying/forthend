<?php
namespace AuthorityControl\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	/**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'user';
    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = true;

    /*
     * 定义和角色的关联关系
     */
    public function roles()
    {
        return $this->belongsToMany('AuthorityControl\Model\Role', 'user_role', 'uid', 'role_id');
    }
}