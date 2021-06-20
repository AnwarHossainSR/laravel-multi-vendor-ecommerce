<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order()
    {
        return \view('frontend.pages.order.index');
    }
    public function orderStore(Request $request)
    {
        return $request;
    }
}
