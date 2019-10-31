<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Carbon\Carbon;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ShoppingCartController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }
    //them gio hang
    public function addProduct(Request $request,$id){
        $product = Product::select('pro_name','id','pro_price','pro_sale','pro_avatar','pro_number')->find($id);

        if(!$product){
            return redirect('/');
        }

        $price = $product->pro_price;
        if($product->pro_sale)
        {
            $price = $price * (100 - $product->pro_sale)/ 100;
        }

        if($product->pro_number == 0){
            return redirect()->back()->with('warning','Sản phẩm đã hết hàng');
        }

        Cart::add([
            'id' => $id,
            'name' => $product->pro_name,
            'qty' => 1,
            'price' => $price,
            'options' => [
                'avatar' => $product->pro_avatar,
                'sale'   => $product->pro_sale,
                'price_old' => $product->pro_price
            ]//them
        ]);

        return redirect()->back()->with('success','Sản phẩm đã được thêm vào giỏ hàng');
    }
    //danh sach gio hang
    public function getListShoppingCart(){
        $products = Cart::content();
        return view('shopping.index',compact('products'));
    }

    //update gio hang
    public function getUpdateCart(Request $request){
        if($request->ajax()){
            Cart::update($request->rowId,$request->qty);
        }
    }

    //xoa gio hang
    public function deleteProductItem($id){
        Cart::remove($id);
        return redirect()->back();
    }

    //form thanh toan
    public function getFormPay(){
        $products = Cart::content();
        return view('shopping.pay',compact('products'));
    }


    //luu thong tin gio hang
    public function saveInfoShoppingCart(Request $request){
        //gui mail
        $data['info'] = $request->all();
        $email = $request->email;
        $data['total'] = str_replace(',','',Cart::subtotal(0,3));
        $data['cart'] = Cart::content();
        Mail::send('email.email_cart', $data, function ($message) use ($email){
            /*$message->from('parksaming@gmail.com', 'Ngọc Tân');*/

            $message->to($email,$email);

            $message->cc('parksaming@gmail.com','Ngọc Tân');

            $message->subject('Đơn mua hàng của quý khách Tanproshop');
        });

        //luu database
        $totalMoney = str_replace(',','',Cart::subtotal(0,3));
        $transactionId = Transaction::insertGetId([
            'tr_user_id' => get_data_user('web'),
           'tr_total' => (int)$totalMoney,
           'tr_note'  => $request->note,
           'tr_address'=> $request->adress,
           'tr_username'=> $request->username,
           'tr_phone'=> $request->phone,
            'tr_payment'=> $request->payment_method,
           'created_at' => Carbon::now(),
           'updated_at' => Carbon::now()
        ]);

        if($transactionId){
            $products = Cart::content();
            foreach ($products as $product){
                Order::insert([
                    'or_transaction_id' => $transactionId,
                    'or_product_id' => $product->id,
                    'or_qty'=>$product->qty,
                    'or_price'=>$product->options->price_old,
                    'or_sale'=>$product->options->sale,
                ]);
            }
        }
        Cart::destroy();
        return redirect()->route('complete.shopping.cart');
    }
    public function getComplete(Request $request){

        //thanh toan the vnpay
        if(isset($request->vnp_ResponseCode) && $request->vnp_ResponseCode == 0){//get dữ liệu từ url

            $transactionId = Transaction::insertGetId([
                'tr_user_id' => get_data_user('web'),
                'tr_total' => $request->vnp_Amount / 100,
                'tr_note'  => $request->vnp_OrderInfo,
                'tr_address'=> get_data_user('web','address'),
                'tr_username'=>  get_data_user('web','name'),
                'tr_phone'=>  get_data_user('web','phone'),
                'tr_payment'=> $request->vnp_BankCode,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            if($transactionId){
                $products = Cart::content();
                foreach ($products as $product){
                    Order::insert([
                        'or_transaction_id' => $transactionId,
                        'or_product_id' => $product->id,
                        'or_qty'=>$product->qty,
                        'or_price'=>$product->options->price_old,
                        'or_sale'=>$product->options->sale,
                    ]);
                }
            }

            Cart::destroy();
        }

        return view('shopping.complete');
    }

}

/*Ngân hàng: NCB
Số thẻ: 9704198526191432198
Tên chủ thẻ:NGUYEN VAN A
Ngày phát hành:07/15
Mật khẩu OTP:123456*/
