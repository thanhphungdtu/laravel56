<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestPassword;
use App\Models\Product;
use App\Models\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //show tong quan user
    public function index(){

        $transactions =  Transaction::where('tr_user_id',get_data_user('web'))
            ->paginate(10);

        //tong don hang
        $totalTransaction = Transaction::where('tr_user_id',get_data_user('web'))
            ->select('id')
            ->count();

        //da xu ly
        $totalTransactionDone = Transaction::where('tr_user_id',get_data_user('web'))
            ->where('tr_status',Transaction::STATUS_DONE)
            ->select('id')
            ->count();

        //chua xu ly
        $totalTransactionDefault = Transaction::where('tr_user_id',get_data_user('web'))
            ->where('tr_status',Transaction::STATUS_DEFAULT)
            ->select('id')
            ->count();

        $viewData = [
            'totalTransaction'=>$totalTransaction,
            'totalTransactionDone'=>$totalTransactionDone,
            'totalTransactionDefault'=>$totalTransactionDefault,
            'transactions' => $transactions
        ];
        return view('user.index',$viewData);
    }

    public function updateInfo(){
        $user = User::find(get_data_user('web'));
        return view('user.info',compact('user'));
    }

    public function postUpdateInfo(Request $request){
         User::where('id',get_data_user('web'))
            ->update($request->except('_token'));

        return redirect()->back()->with('success','Cập nhật thông tin thành công');
    }

    //update password
    public function updatePassword(){
        return view('user.password');
    }

    public function postUpdatePassword(RequestPassword $requestPassword){
        if (Hash::check($requestPassword->old_password,get_data_user('web','password')))
        {
            $user = User::find(get_data_user('web'));
            $user->password = bcrypt($requestPassword->password);
            $user->save();

            return redirect()->back()->with('success','Cập nhật mật khẩu thành công');
        }
        return redirect()->back()->with('danger','Mật khẩu cũ không đúng');
    }

    public function getProductPay(){
        $products = Product::orderBy('pro_pay','DESC')->limit(10)->get();
        return view('user.product',compact('products'));
    }
}
