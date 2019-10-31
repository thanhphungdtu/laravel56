<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Requests\RequestProduct;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class AdminProductController extends Controller
{

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    //list product
    public function index(Request $request){
        $products = $this->product->productList($request);

        $categories = $this->product->getCategories();

        $viewData = [
            'products'   => $products,
            'categories' => $categories
        ];
        return view('admin::product.index',$viewData);
   }
    //view san pham
   public function create(){
       $categories = $this->product->getCategories();
       return view('admin::product.create',compact('categories'));
   }
   //them sp
   public function store(RequestProduct $requestProduct){
       //dd($requestProduct->all());
       $this->product->insertOrUpdate($requestProduct);
       return redirect()->route('admin.get.list.product')->with('success','Thêm mới sản phẩm thành công');
   }
   //view update
   public function edit($id){
       $categories = $this->product->getCategories();
      $product = $this->product->productId($id);
      return view('admin::product.update',compact('product','categories'));
   }
   //cap nhat sp
   public function update(RequestProduct $requestProduct,$id){

       $this->product->insertOrUpdate($requestProduct,$id);
       return redirect()->route('admin.get.list.product')->with('success','Cập nhật sản phẩm thành công');
   }


    public function action($action,$id){

        $msgProduct = $this->product->productAction($action,$id);
        return redirect()->back()->with('success',$msgProduct);
    }
}
