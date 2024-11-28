<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

use Illuminate\Support\Facades\Log;

class AccountController extends Controller
{

    function getLogin() {
        if(session()->get('user')){
            return redirect()->route('admin.getDashboard');
        }else{
            return view('backend.login.index');
        }


        // if(Auth::check()){
        //     dd('getLogin');
        //     // return redirect()->route('admin.getDashboard');
        // }else{
        //     return view('backend.login.index');
        // }
    }

    function postLogin(Request $request) {
        
        // $validator = Validator::make($request->all(), [
        //     'username' => 'required|string|max:255',
        //     'password' => 'required|string|max:255',
        // ], [
        //     'username.required' => 'Thông tin bắt buộc.',
        //     'username.string' => 'Tài khoản không hợp lệ.',
        //     'username.max' => 'Tài khoản quá dài.',

        //     'password.required' => 'Thông tin bắt buộc.',
        //     'password.string' => 'Mật khẩu không hợp lệ.',
        //     'password.max' => 'Mật khẩu quá dài.',

        // ]);
        
        // if ($validator->fails()) {
        //     dd($validator->errors());
        // }
        
        $phonenumber = $request->input('phonenumber');
        $password = $request->input('password');      
        $remember = ($request->input('remember')) ? true : false;
        
        // $phonenumber = "0368054220";
        // $password = 'N123456';
        $user = User::where('usr_phone', $phonenumber)->first();

        // dump($user && Hash::check($password, $user->usr_password));
        if ($user && Hash::check($password, $user->usr_password)) {
            Session::put('user', $user);
            Log::info('Đăng nhập thành công '. session()->get('user')->username ); 
 
            if ( $remember ) {
                Cookie::queue('log_phone', $request->usr_phone, 60 * 24 * 7); // 30 ngày
                Cookie::queue('log_password', $request->password, 60 * 24 * 7); // 30 ngày
            }
            return redirect()->route('admin.getDashboard');    
            // return redirect()->route('getDashboard');
        }

        return redirect()->route('account.getLogin');

        // return view('backend.login.index');
                // $credentials = $request->only('username', 'password');
        // if( Auth::attempt($credentials, $remember) ){
        //     return redirect()->route('getDashboard');
        // }
    }
    public function logout(Request $request)
    {

        Session::forget('user');

        // Xóa cookie nếu có
        Cookie::queue(Cookie::forget('username'));
        Cookie::queue(Cookie::forget('password'));

        return redirect()->route('account.getLogin');
        
        // Auth::logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        // if(Auth::check()){
        //     // return redirect()->route('admin.getDashboard');
        //     dd('logout');
        // }else{
        //     return view('backend.login.index');
        // }
    }

    public function getDashboard() {
        
        // $session = session()->all();

        // dump($session);


        return view('backend.admin.dashboard.index');
    }



}
