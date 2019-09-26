<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //首页展示
    public function root()
    {
        return view('pages.root');
    }

    public function permissionDenied()
    {
// 如果当前⽤⼾有权限访问后台，直接跳转访问
        if (config('administrator.permission')()) {
            return redirect(url(config('administrator.uri')), 302);
        }
// 否则使⽤视图
        return view('pages.permission_denied');
    }
}
