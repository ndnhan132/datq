<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;


class AccountController extends Controller
{
    function getLogin() {
        if(Auth::check()){
            // return redirect()->route('admin.getDashboard');
        }else{
            return view('backend.login.index');
        }
    }

    function postLogin(Request $request) {

        
        $credentials = $request->only('email', 'password');
        $data = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
            ];
        $remember = ($request->input('remember')) ? true : false;
        Auth::attempt($credentials, $remember);


        if(Auth::check()){
            return redirect()->route('admin.getDashboard');
        }else{
            return view('backend.login.index');
        }
    }
    public function logout()
    {
        Auth::logout();
        if(Auth::check()){
            return redirect()->route('admin.getDashboard');
        }else{
            return view('backend.login.index');
        }
    }




}
