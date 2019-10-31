<?php

namespace App\Exports;


use App\Models\Transaction;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;

class CsvExport implements FromCollection
{
    //xuất đơn hàng
    public function collection()
    {
        $request = request();
        $value = request('name', $default = null);
        $data = null;
        if($value)
        {
            $transaction = Transaction::where('tr_username','like','%'.$value.'%');
            $data = $transaction->select('tr_username','tr_address','tr_phone','created_at','tr_total')->orderBy('id','DESC')->get();
        }
        else
            $data = Transaction::select('tr_username','tr_address','tr_phone','created_at','tr_total')->orderBy('id','DESC')->get();
        return  $data;


    }
}
