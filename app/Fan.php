<?php
/**
 * Created by JiFeng.
 * User: 10927
 * Date: 2018/7/31
 * Time: 20:51
 */

namespace App;
use Illuminate\Support\Facades\Auth;

/**
 * App\Fan
 *
 * @property int $id
 * @property int $fan_id
 * @property int $star_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\User $fuser
 * @property-read \App\User $suser
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Fan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Fan whereFanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Fan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Fan whereStarId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Fan whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Fan extends BaseModel
{
    /**
     * 粉丝用户
     */
    public function fuser(){
        return $this->hasOne('App\User','id','fan_id');
    }

    /**
     * 被关注的用户
     */
    public function suser(){
        return $this->hasOne('App\User','id','star_id');
    }
}