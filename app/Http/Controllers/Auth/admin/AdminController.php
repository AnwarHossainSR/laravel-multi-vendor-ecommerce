<?php

namespace App\Http\Controllers\Auth\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return \view('backend.auth.admin.login');
    }
    public function adminCrediential(Request $request)
    {
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){
            return \redirect()->route('admin')->with('success','Login as admin');
        }else{
            //return \back()->with('error','Crediential does not matched');
            return \back()->withInput($request->only('email'))->with('error','Crediential does not matched in our records');
        }
    }
}
