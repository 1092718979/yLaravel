<?php
/**
 * Created by JiFeng.
 * User: 10927
 * Date: 2018/8/5
 * Time: 21:47
 */

namespace App\Admin\Controller;


class HomeController
{
    /**
     * 首页
     */
    public function index(){
        return view('admin.home.index');
    }
}