<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Requests\RequestLogin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function getLogin(){
        return view('admin::auth.login');
    }

    public function postLogin(RequestLogin $request){
        $data = $request->only('email', 'password');

        if (Auth::guard('admins')->attempt($data)) {
            return redirect()->route('admin.home');
        }else{
            return redirect()->route('admin.login')->with('thongbao','Sai Email hoặc mật khẩu');
        }
    }
    public function getLogout(){
        Auth::guard('admins')->logout();
        return redirect()->route('admin.login');
    }

    public function getErros(){
        return view('admin::errors.403');
    }
}
