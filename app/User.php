<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string $avatar
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Fan[] $fans
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Post[] $posts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Fan[] $stars
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    protected $fillable = [
        'name','email','password'
    ];

    /**
     * 用户的文章
     */
    public function posts()
    {
        return $this->hasMany(\App\Post::class, 'user_id', 'id');
    }
    /**
     * 我的粉丝
     */
    public function fans(){
        return $this->hasMany('\App\Fan','star_id','id');
    }

    /**
     * 我关注的Fan模型
    */
    public function stars(){
        return $this->hasMany('\App\Fan','fan_id','id');
    }

    /**
     * 关注某人
     */
    public function doFan($uid){
        $fan = new \App\Fan();
        $fan->star_id = $uid;
        return $this->stars()->save($fan);
    }

    /**
     * 取消关注
     */
    public function doUnFan($uid){
        $fan = new \App\Fan();
        //$fan->star_id = $uid;
        return $this->stars()->delete($fan);
    }

    /**
     * 当前用户是否被uid关注了
     */
    public function hasFan($uid){
        return $this->fans()->where('fan_id',$uid)->count();
    }

    /**
     * 当前用户是否关注了uid
     */
    public function hasStar($uid){
        return $this->stars()->where('star_id',$uid)->count();
    }
}









