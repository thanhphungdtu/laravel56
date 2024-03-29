<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\FrontendController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends FrontendController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function getLogin(){
        return view('auth.login');
    }

    public function postLogin(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            if(get_data_user('web','active') == 1){
                return redirect()->route('get.login')->with('danger','Tài khoản của bạn chưa được kích hoạt. Hãy check địa chỉ Email của bạn để kích hoạt.');
            }else{
                return redirect()->route('home');
            }

        }

        return redirect()->back()->with('danger','Đăng nhập thất bại');
    }
    public function getLogout(){
        Auth::logout();
        return redirect()->route('home');
    }

}
