<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home()
    {
        $banners=Banner::where('status','active')->limit(3)->orderBy('id','DESC')->get();
        return \view('frontend.index',\compact('banners'));
    }
}
