<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class AdminDiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::all();
        return view('admin::discount.index',compact('discounts'));
    }

    /*public function create(){
        return view('admin::discount.create');
    }*/

    public function store(Request $request){


        /*$discounts = new Discount();
        $discounts->d_name = $request->d_name;
        $discounts->d_qty = $request->d_qty;
        $discounts->d_val = $request->d_val;
        $discounts->save();

        return redirect()->route('admin.get.list.discount')->with('success','Thêm mới mã giảm giá thành công');*/
        $validator = Validator::make($request->input(), array(
            'd_name' => 'required',
            'd_qty' => 'required',
            'd_val' => 'required',
        ));

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $task = Discount::create($request->all());

        return response()->json([
            'error' => false,
            'task'  => $task,
        ], 200);
    }

    public function show($id){
        $task = Discount::find($id);

        return response()->json([
            'error' => false,
            'task'  => $task,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->input(), array(
            'd_name' => 'required',
            'd_qty' => 'required',
            'd_val' => 'required',
        ));

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $task = Discount::find($id);

        $task->d_name=  $request->input('d_name');
        $task->d_qty = $request->input('d_qty');
        $task->d_val = $request->input('d_val');

        $task->save();

        return response()->json([
            'error' => false,
            'task'  => $task,
        ], 200);
    }

}
