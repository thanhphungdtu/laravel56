<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $guarded = ['*'];

    const STATUS_DONE = 1;
    const STATUS_DEFAULT = 0;

    public function user(){
        return $this->belongsTo(User::class,'tr_user_id');
    }

    public function transactionList($request){

        if($request->name)
        {
            return Transaction::with('user:id,name')->where('tr_username','like','%'.$request->name.'%')->orderBy('id','DESC')->paginate(20);
        }
        return Transaction::with('user:id,name')->orderBy('id','DESC')->paginate(20);
    }

    public function transactionId($id){
        return Transaction::find($id);
    }
}
