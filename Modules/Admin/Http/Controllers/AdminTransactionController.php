<?php

namespace Modules\Admin\Http\Controllers;

use App\Exports\CsvExport;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AdminTransactionController extends Controller
{
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function index(Request $request )
    {

        $transactions =  $this->transaction->transactionList($request);

        $viewData = [
          'transactions' => $transactions
        ];
        return view('admin::transaction.index',$viewData);
    }

    public function viewOrder(Request $request,$id){

        if($request->ajax())
        {
            $orders = Order::with('product')
                    ->where('or_transaction_id',$id)->get();
            $html = view('admin::components.order',compact('orders'))->render();
            return \response()->json($html);
        }
    }
    //xử lý trạng thái đơn hàng
    public function activeTransaction($id){
        $transaction = $this->transaction->transactionId($id);
        //lay chi tiet don hang
        $orders = Order::where('or_transaction_id',$id)->get();
        if($orders){//neu ton tai, foreach
            //trừ đi số lượng của sản phẩm
            //tăng biến pay sản phẩm
            foreach ($orders as $order)
            {
                $product = Product::find($order->or_product_id);
                $product->pro_number = $product->pro_number - $order->or_qty;
                $product->pro_pay ++;
                $product->save();
            }
        }
        //update user
        DB::table('users')->where('id',$transaction->tr_user_id)
            ->increment('total_pay');

        //Cap nhat lai trang thai don hang
        $transaction->tr_status = Transaction::STATUS_DONE;
        $transaction->save();
        return redirect()->back()->with('success','Xử lý đơn hàng thành công');
    }

    public function delete($id){
        $transactions = $this->transaction->transactionId($id);
        $transactions->delete();
        return redirect()->back()->with('success','Xóa đơn hàng thành công');
    }

    public function csv_export(){
        return Excel::download(new CsvExport, 'order.csv');
    }
}
