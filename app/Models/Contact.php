<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';
    protected $guarded = ['*'];

    protected $status = [
        1 => [
            'name' => 'Đã xử lý',
            'class'=> 'label-danger'
        ],
        0 =>[
            'name' =>'Chưa xử lý',
            'class'=>'label-default'
        ]
    ];

    public function getStatus(){
        return array_get($this->status,$this->c_status, '[N\A]');
    }
}
