<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getListProduct(Request $request){
        $url = $request->segment(2);
        $url = preg_split('/(-)/i',$url);

        $products = Product::where('pro_active',Product::STATUS_PUBLIC);
        $cateProduct = [];
        if($id = array_pop($url)){
            //show sp theo danh muc
            $cateProduct = Category::find($id);

            $products->where('pro_category_id',$id);
        }

        //tim kiem sp
        if ($request->search){
            $products->where('pro_name','like','%'.$request->search.'%');

        }

        //tìm kiếm theo giá sp
        if ($request->price){//lay duong dan request
            $price = $request->price;
            switch ($price)
            {
                case '1'://duoi 1 trieu
                    $products->where('pro_price','<',1000000);
                    break;
                case '2':
                    $products->whereBetWeen('pro_price',[1000000,3000000]);//gia trị nằm trong khoảng
                    break;
                case '3':
                    $products->whereBetWeen('pro_price',[3000000,5000000]);
                    break;
                case '4':
                    $products->whereBetWeen('pro_price',[5000000,7000000]);
                    break;
                case '5':
                    $products->whereBetWeen('pro_price',[7000000,10000000]);
                    break;
                case '6'://duoi 1 trieu
                    $products->where('pro_price','>',10000000);
                    break;

            }
        }
        //tiếm kiếm theo danh mục
        if ($request->orderby){

            $orderby = $request->orderby;

            switch ($orderby)
            {
                case 'desc':
                    $products->orderBy('id','DESC');
                    break;

                case 'desc':
                    $products->orderBy('id','ASC');
                    break;

                case 'price_max':
                    $products->orderBy('pro_price','ASC');
                    break;
                case 'price_min':
                    $products->orderBy('pro_price','DESC');
                    break;
                default:
                    $products->orderBy('id','DESC');
            }
        }

        $products = $products->paginate(3);

        $viewData = [
            'products' => $products,
            'cateProduct' => $cateProduct,
            'query' => $request->query()
        ];

        return view('product.index',$viewData);

        //return redirect()->route('home');
    }
}
