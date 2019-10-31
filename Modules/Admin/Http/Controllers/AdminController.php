<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Contact;
use App\Models\Rating;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $ratings = Rating::with('user:id,name','product:id,pro_name')->limit(10)->get();
        $contacts = Contact::limit(10)->get();

        //doanh thu ngay
        $moneyDay = Transaction::whereDay('updated_at',date('d'))
            ->where('tr_status',Transaction::STATUS_DONE)//da xu ly
            ->sum('tr_total');//tong


        //doanh thu tháng
        $moneyMonth = Transaction::whereMonth('updated_at',date('m'))//thang m
        ->where('tr_status',Transaction::STATUS_DONE)
            ->sum('tr_total');

        //doanh thu năm
        $moneyYear = Transaction::whereYear('updated_at',date('Y'))//thang m
            ->where('tr_status',Transaction::STATUS_DONE)
            ->sum('tr_total');

        $dataMoney = [
            [
                "name" => "Doanh thu ngày",
                "y"    => (int)$moneyDay
            ],
            [
                "name" => "Doanh thu tháng",
                "y"    => (int)$moneyMonth
            ],
            [
                "name" => "Doanh thu năm",
                "y"    => (int)$moneyYear
            ]
        ];

        //danh sach don hang moi nhat
        $transactionNews = Transaction::with('user:id,name')
            ->where('tr_status',Transaction::STATUS_DEFAULT)
            ->orderBy('id','DESC')
            ->limit(5)->get();

        //danh sach danh gia moi nhat
        $ratings = Rating::with('user:id,name','product:id,pro_name')
            ->orderBy('id','DESC')
            ->limit(5)->get();

        $viewData = [
            'ratings' => $ratings,
            'contacts'=> $contacts,
            'dataMoney'=> json_encode($dataMoney),
            'transactionNews'=> $transactionNews,
            'ratings' => $ratings
        ];
        return view('admin::index',$viewData);
    }


}
