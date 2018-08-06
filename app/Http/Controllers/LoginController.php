<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * 登陆页面
     */
    public function index()
    {
        if (Auth::check()){
            return redirect('posts');
        }

        return view('login/login');
    }

    /**
     * 登陆行为
     */
    public function login()
    {
        //验证
        $this->validate(request(),[
            'email' => 'required|email',
            'password' => 'required|min:5',
            'is_remember' => 'integer',
        ]);
        //逻辑
        $user = request(['email','password']);
        $is_remember = boolval(request('is_remember'));
        if (Auth::attempt($user,$is_remember)){
            return redirect('posts');
        }
        //渲染
        return redirect()->back()->withErrors('用户名或密码错误。');
    }

    /**
     * 登出行为
     */
    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
