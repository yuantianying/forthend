<?php
namespace AuthorityControl\Model;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
	/**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'access';
    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;
}