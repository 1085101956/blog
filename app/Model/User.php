<?php
/**
 * Created by PhpStorm.
 * User: 林志伟
 * Date: 2020/2/23
 * Time: 0:58
 */
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
    //关联数据表
    public $table = 'user';
    //主键
    public $primaryKey = 'user_id';
    //允许操作的字段
    public $fillable = ['user_name','user_pass','email','photo','phone','create_time','status'];
    //不允许操作的字段
    //public $guarded = [];
    //是否维护created_at 和updated_at 字段
    public $timestamps = false;

}