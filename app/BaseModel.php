<?php
/**
 * Created by JiFeng.
 * User: 10927
 * Date: 2018/7/21
 * Time: 18:00
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

/**
 * App\BaseModel
 *
 * @mixin \Eloquent
 */
class BaseModel extends Model{
    //可以赋值的属性   --白名单
    //protected $fillable = [];
    //不可赋值的属性   --黑名单
    protected $guarded = [];


}