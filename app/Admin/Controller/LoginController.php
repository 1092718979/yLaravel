<?php
/**
 * Created by JiFeng.
 * User: 10927
 * Date: 2018/8/5
 * Time: 21:23
 */

namespace App\Admin\Controller;


class LoginController extends Controller
{
    /**
     * 登陆展示页面
     */
    public function index(){
        return view('admin.login.index');
    }

    /**
     * 登陆行为
     */
    public function login(){

    }

    /**
     * 登出行为
     */
    public function logout(){

    }
}