<?php
/**
 * Created by JiFeng.
 * User: 10927
 * Date: 2018/8/2
 * Time: 16:01
 */

namespace App;


class Topic extends BaseModel
{
    /**
     * 专题的文章
     */
    public function posts(){
        return $this->belongsToMany('\App\Post','post_topics','topic_id','post_id');
    }

    /**
     * 属于这个专题的文章
     */
    public function postTopics(){
        return $this->hasMany(\App\PostTopic::class,'topic_id','id');
    }
}