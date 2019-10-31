<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\FrontendController;
use Carbon\Carbon;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends FrontendController
{
    public function getRegister(){
        return view('auth.register');
    }

    public function postRegister(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->save();

        if($user->id){

            $email = $user->email;

            $code = bcrypt(md5(time().$email));
            $url = Route('user.verify.account',['id' => $user->id,'code' => $code]);

            $user->code_active  = $code;
            $user->time_active  = Carbon::now();
            $user->save();

            $data = [
                'route' => $url
            ];

            Mail::send('email.verify_account', $data, function($message) use ($email){
                $message->to($email, 'Xác nhận tài khoản')->subject('Xác nhận đăng ký tài khoản!');
            });

            return redirect()->route('get.login')->with('success','Vui lòng xác nhận đăng ký Email, Để sử dụng tài khoản');
        }
        return redirect()->back();
    }

    //xac nhan tai khoan
    public function verifyAccount(Request $request){
        $code = $request->code;
        $id = $request->id;

        $checkUser = User::where([
            'code_active' => $code,
            'id' => $id
        ])->first();

        if(!$checkUser){//truong hop nhap tum bay tren url
            return redirect('/')->with('danger','Xin lổi ! Đường dẫn xác nhận tài khoản không tồn tại,bạn vui lòng thử lại sau.');
        }

        $checkUser->active = 2;
        $checkUser->save();

        return redirect('/')->with('success','Xác nhận tài khoản thành công!');

    }

}
