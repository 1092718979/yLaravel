<?php
/**
 * Created by JiFeng.
 * User: 10927
 * Date: 2018/8/2
 * Time: 16:01
 */

namespace App;


/**
 * App\PostTopic
 *
 * @property int $id
 * @property int $post_id
 * @property int $topic_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostTopic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostTopic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostTopic wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostTopic whereTopicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostTopic whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PostTopic extends BaseModel
{

}