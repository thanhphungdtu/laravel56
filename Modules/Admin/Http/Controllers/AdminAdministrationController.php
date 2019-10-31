<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class AdminAdministrationController extends Controller
{
    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function index(){

        $admins = $this->admin->administrationList();
        return view('admin::administration.index',compact('admins'));
    }

    public function create(){
        return view('admin::administration.create');
    }

    public function store(Request $request){
        $this->admin->administrationStore($request);
        return redirect()->route('admin.get.list.admin')->with('success','Thêm mới ban quản trị thành công');
    }

    public function edit($id){
        $admins = $this->admin->administrationId($id);
        if(get_data_user('admins','role') == 1 )

        {
            if(get_data_user('admins','id') == 1 && get_data_user('admins','username') == 'admin')
            {
                return view('admin::administration.update',compact('admins'));
            }
            else
            {
                // admin thuong
                if(get_data_user('admins','id') == $id || $admins['role'] == 2)
                {
                    return view('admin::administration.update',compact('admins'));
                }
                else
                {
                    return redirect()->route('admin.get.list.admin')->with('danger','Bạn không có quyền sửa admin khác hoặc supper admin!!');
                }
            }
        }
        else
        {
            if (get_data_user('admins','id') == $id){
                return view('admin::administration.update',compact('admins'));
            }
            else{
                return redirect()->route('admin.get.list.admin')->with('danger','Bạn không có quyền sửa ok!!');
            }
        }

    }

    public function update(Request $request,$id){
        $this->admin->administrationUpdate($request, $id);
        return redirect()->route('admin.get.list.admin')->with('success','Cập nhật ban quản trị thành công');
    }

    public function delete($id){
        $this->admin->administrationDelete($id);
        return redirect()->route('admin.get.list.admin')->with('success','Xóa ban quản trị thành công');
    }
}
