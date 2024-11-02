<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class AccountController extends Controller
{

    function getLogin() {


        dump( Auth::id() );

        $usename = 'adminnhan';
        $password = 'T@#123456'; 



        $session = session()->all();

        dump($session);
        if(Auth::check()){
            dd('getLogin');
            // return redirect()->route('admin.getDashboard');
        }else{
            return view('backend.login.index');
        }
    }

    function postLogin(Request $request) {

        // dd($request);
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ], [
            'username.required' => 'Thông tin bắt buộc.',
            'username.string' => 'Tài khoản không hợp lệ.',
            'username.max' => 'Tài khoản quá dài.',

            'password.required' => 'Thông tin bắt buộc.',
            'password.string' => 'Mật khẩu không hợp lệ.',
            'password.max' => 'Mật khẩu quá dài.',

        ]);
        
        if ($validator->fails()) {
            dd($validator->errors());
        }
        $remember = ($request->input('remember')) ? true : false;
        $credentials = $request->only('username', 'password');

        
        
        if( Auth::attempt($credentials, $remember) ){
            Log::info(session()->all());
            // $id = Auth::id();
            // dump($id);
            // Auth::loginUsingId($id);

            // $user = Auth::user();
            // dump( $user->getAuthIdentifier() );

            // dump( $session = session()->all() );
            // $request->session()->regenerate();
            dump( $session = session()->all() );
            // session()->put( $session );
            // foreach ($session as $key => $value) {

            // }
            // dd('đăng nhập thành công');

            // return response()->json([
            //     'status' => session()->all(),
            // ], 201);
            return redirect()->route('getDashboard');
            // return redirect()->route('account.getLogin');
            
        }else{
            return view('backend.login.index');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        if(Auth::check()){
            // return redirect()->route('admin.getDashboard');
            dd('logout');
        }else{
            return view('backend.login.index');
        }
    }

    public function getDashboard() {
        
        $session = session()->all();

        dump($session);


        return view('backend.admin.dashboard.index');
    }



}
