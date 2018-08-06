<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * 注册页面
     */
    public function index()
    {

        return view('register.index');
    }

    /**
     * 注册行为
     *     unique:表明，字段名
     *     名字为  password 和 password_confirmation    会自动验证两个值是否相同
     */
    public function register()
    {
        //验证
        $this->validate(request(),[
            'name' => 'required|min:3|unique:users,name',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:5|max:15',
        ]);
        //逻辑
        $name = request('name');
        $email = request('email');
        $password = bcrypt(request('password'));    //laravel明文转成秘文
        $user = User::create(compact('name','email','password'));
        //渲染页面
        return redirect('login');
    }
}
