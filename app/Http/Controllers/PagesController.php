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
}
