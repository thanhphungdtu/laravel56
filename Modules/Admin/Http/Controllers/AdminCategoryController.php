<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\Category;
use App\Http\Requests\RequestCategory;

class AdminCategoryController extends Controller
{
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $categories = $this->category->categoryList();
        $viewData = [
            'categories' => $categories
        ];
        return view('admin::category.index',$viewData);
    }

    public function create(){
        $parent = Category::select('id','c_name','parent_id')->get()->toArray();
        return view('admin::category.create',compact('parent'));
    }

    public function store(RequestCategory $requestCategory){
        $this->category->categoryStore($requestCategory);
        return redirect()->route('admin.get.list.category')->with('success','Thêm mới danh mục thành công');
    }

    public function edit($id){
        $parent = Category::select('id','c_name','parent_id')->get()->toArray();
        $category = $this->category->categoryID($id);
        return view('admin::category.update',compact('category','parent'));
    }
    public function update(RequestCategory $requestCategory,$id){
        $this->category->categoryUpdate($requestCategory,$id);
        return redirect()->route('admin.get.list.category')->with('success','Cập nhật danh mục thành công');
    }
    public function action($action,$id){
       $msgCate = $this->category->categoryAction($action,$id);
        return redirect()->back()->with('success',$msgCate);
    }
}
