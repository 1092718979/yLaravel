<?php

namespace App\Http\Controllers;

use App\Fan;
use \App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * 个人设置页面
     */
    public function setting()
    {
        $user = Auth::user();
        return view('user/setting',compact('user'));
    }

    /**
     * 个人设置行为
     */
    public function settingStore()
    {
        $this->validate(request(),[
            'name' => 'required|min:3',
        ]);
        $name = request('name');
        $user = Auth::user();
        if ($name != $user->name)
        {
            if (User::where('name',$name)->count() > 0)
            {
                return back()->withErrors('用户名称已经被注册');
            }
            $user->name = $name;
        }
        if (request()->file('avatar'))
        {
            $path = request()->file('avatar')->storePublicly($user->id);
            $user->avatar = "/storage/".$path;
        }
        $user->save();
        return back();
    }

    /**
     * 个人中心页面
     */
    public function show(User $user){
        //个人信息，关注/粉丝/文章数
        $user = User::withCount(['stars','fans','posts'])->find($user->id);
        $posts = $user->posts()->orderBy('created_at','desc')->take(10)->get();
        //这个人关注的用户信息，关注/粉丝/文章数
        $stars = $user->stars;
        $susers = User::whereIn('id',$stars->pluck('star_id'))
                ->withCount(['stars','fans','posts'])
                ->get();
        //关注这个人的用户信息，关注/粉丝/文章数
        $fans = $user->fans;
        $fusers = User::whereIn('id',$fans->pluck('fan_id'))
                ->withCount(['stars','fans','posts'])
                ->get();
        return view('user/show',compact('user','posts','susers','fusers'));
    }

    /**
     * 关注用户
     */
    public function fan(User $user){
        $me = Auth::user();
        $me->doFan($user->id);

        return [
            'error' => 0,
            'msg' => ''
        ];
    }

    /**
     * 取消关注
     */
    public function unfan(User $user){
        $me = Auth::user();
        $me->doUnFan($user->id);
        return [
            'error' => 0,
            'msg' => ''
        ];
    }
}












