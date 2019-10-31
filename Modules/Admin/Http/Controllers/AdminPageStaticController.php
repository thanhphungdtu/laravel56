<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\PageStatic;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class AdminPageStaticController extends Controller
{
    public function index(){
        $pageStatics = PageStatic::all();
        return view('admin::page_static.index',compact('pageStatics'));
    }

    public function create(){
        return view('admin::page_static.create');
    }

    public function store(Request $request){
       $this->insertOrUpdate($request);
       return redirect()->route('admin.get.list.page_static')->with('success','Thêm mới Page tỉnh thành công');
    }

    public function edit($id){
        $pageStatics = PageStatic::find($id);
        return view('admin::page_static.update',compact('pageStatics'));
    }

    public function update(Request $request,$id){
        $this->insertOrUpdate($request,$id);
         return redirect()->route('admin.get.list.page_static')->with('success','Cập nhật Page tỉnh thành công');
    }

    public function insertOrUpdate($request, $id = ''){
        $pageStatics = new PageStatic();
        if ($id){
            $pageStatics = PageStatic::find($id);
        }
        $pageStatics->ps_name = $request->ps_name;
        $pageStatics->ps_content = $request->ps_content;
        $pageStatics->ps_type = $request->type;
        $pageStatics->save();
    }
}
