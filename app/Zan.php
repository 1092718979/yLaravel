<?php
/**
 * Created by JiFeng.
 * User: 10927
 * Date: 2018/7/31
 * Time: 10:02
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Zan
 *
 * @property int $id
 * @property int $user_id
 * @property int $post_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Zan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Zan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Zan wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Zan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Zan whereUserId($value)
 * @mixin \Eloquent
 */
class Zan extends BaseModel
{

}