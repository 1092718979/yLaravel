<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Zan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    /**
     * 文章列表页面
     */
    public function index(){
        $posts = Post::orderBy('created_at','desc')
            ->withCount(['comments','zans'])
            ->paginate(6);
        return view("post/index",compact('posts'));      //参数1：对应resources/views/post/index  参数2：传递给文章的参数模板
    }

    /**
     * 详情页面
     */
    public function show(Post $post){
        //预加载,不会再view层去查询数据
        $post->load('comments');
        return view('post/show',compact('post'));               //compact()
    }

    /**
     * 创建文章
     */
    public function create(){

        return view('post/create');
    }

    /**
     * 创建逻辑
     */
    public function store(){
        //验证参数和规则
        $this->validate(request(),[
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:5',
        ]);
        //逻辑
        $post = new Post();
        $post->title = request('title');
        $post->content = request('content');
        $post->user_id = Auth::id();
        $post->save();
        //重定向
        return redirect("/posts");
    }

    /**
     * 编辑页面
     */
    public function edit(Post $post){

        return view('post/edit',compact('post'));
    }

    /**
     * 编辑逻辑
     */
    public function update(Post $post){
        //验证
        $this->validate(request(),[
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:5',
        ]);

        $this->authorize('update',$post);

        $post->title = request('title');
        $post->content = request('content');
        $post->save();

        return redirect("posts/{$post->id}");
    }

    /**
     * 删除文章
     */
    public function delete(Post $post){
        //用户权限验证
        $this->authorize('delete',$post);

        $post->delete();
        return redirect('posts');
    }

    /**
     * 提交评论
     */
    public function comment(Post $post){
        $this->validate(request(),[
            'content' => 'required|min:3',
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->content = request('content');
        $post->comments()->save($comment);

        return back();
    }

    /**
     * 上传图片
     */
    public function imageUpload(Request $request){
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/'.$path);
    }

    /**
     * 赞
     */
    public function zan(Post $post){
        $param = [
            'user_id' => Auth::id(),
            'post_id' => $post->id,
        ];
        //firstOrCreate只有在没有的时候才会创建
        Zan::firstOrCreate($param);
        return back();
    }

    /**
     * 取消赞
     */
    public function unzan(Post $post){
        $post->zan(Auth::id())->delete();
        return back();
    }

    /**
     * 依赖注入：从参数中传递一个类，向方法中注入一个对象
     *          注入的类在Application中定义
     */
    public function injection(\Illuminate\Log\Writer $log){
        //获取容器
        $app = app();
        //从容器中获取日志类
        $log = $app->make('log');
        $log->info("post_index",[
            'data' => 'this is post index',
        ]);
        //门脸模式  门帘的注册在boostrap中的app下注册
        \Log::info("post_index",[
            'data' => 'this is post index',
        ]);
    }
}
