<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class AdminWarehouseController extends Controller
{
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getWarehouseProduct(Request $request){
        $products = $this->product->productWarehouseList($request);

        $categories = $this->product->getCategories();


        $viewData = [
            'products'   => $products,
            'categories' => $categories
        ];

        return view('admin::warehouse.index',$viewData);
    }

}
