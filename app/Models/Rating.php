<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'ratings';
    protected $guarded = ['*'];
    public $timestamps = true;

    public function user(){
        return $this->belongsTo(User::class,'ra_user_id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'ra_product_id');
    }

    public function ratingList(){
        return Rating::with('user:id,name','product:id,pro_name')->paginate(10);
    }

    public function ratingAction($action, $id){
        if($action)
        {
            $ratings = Rating::find($id);

            switch ($action)
            {
                case 'delete':
                    $ratings->delete();
                    $msgRating = 'Xóa sản phẩm thành công';
                    break;
            }
        }
        return $msgRating;
    }
}
