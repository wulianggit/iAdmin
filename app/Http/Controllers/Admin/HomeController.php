<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * 后台首页视图
     *
     * @return \Illuminate\Http\Response
     * @author wuliang
     */
    public function index ()
    {
       return view('admin.home.index');
    }
}
