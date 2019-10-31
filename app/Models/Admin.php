<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admins';
    protected $guarded = [''];

    public function administrationList(){

        return Admin::all();
    }

    public function administrationStore($request){
        $admins = new Admin();
        $admins->name = $request->name;
        $admins->email = $request->email;
        $admins->password = bcrypt($request->password);
        $admins->phone = $request->phone;
        $admins->username = $request->username;
        $admins->role = $request->rdoLevel;
        $admins->remember_token = $request->_token;
        $admins->save();
        return $admins;
    }

    public function administrationId($id){
        return Admin::find($id);
    }

    public function administrationUpdate($request,$id){
        $admins = $this->administrationId($id);
        $admins->name = $request->name;
        $admins->password = bcrypt($request->password);
        $admins->phone = $request->phone;
        $admins->username = $request->username;
        $admins->role = $request->rdoLevel;
        $admins->remember_token = $request->_token;
        $admins->save();

        return $admins;
    }

    public function administrationDelete($id){
        $admins = $this->administrationId($id);
        $admins->delete();
        return $admins;
    }
}
