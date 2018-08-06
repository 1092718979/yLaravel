<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * 对应数据库中的 posts
 */
class Post extends BaseModel
{
    //protected $table = '';      指定关联表
    //protected $guarded; //数组不可注入的字段

    protected $fillable = ['title','content','user_id']; //数组可注入字段

    /**
     * 关联用户
     */
    public function user(){
        return $this->belongsTo('App\User');
    }

    /**
     * 关联评论
     */
    public function comments(){
        return $this->hasMany('App\Comment')->orderBy('created_at','desc');
    }

    /**
     * 文章和一个用户的赞的关联
     */
    public function zan($user_id){
        return $this->hasOne('App\Zan')->where('user_id',$user_id);
    }

    /**
     * 文章和所有赞的关联
     */
    public function zans(){
        return $this->hasMany('App\Zan');
    }

    /**
     * 属于某一个作者的文章
     *     scope,命名是--scope驼峰的方式，参数的第一个是Builder对象
     */
    public function scopeAuthorBy(Builder $query,$user_id){
        return $query->where('user_id',$user_id);
    }

    /**
     * 一个文章可以对应多个专题
     */
    public function postTopics(){
        return $this->hasMany('\App\PostTopic','post_id','id');
    }

    /**
     * 不属于某个专题的文章
     */
    public function scopeTopicNotBy(Builder $query,$topic_id){
        return $query->doesntHave('postTopics','and',function($q) use($topic_id){
            $q->where('topic_id',$topic_id);
        });
    }
}
