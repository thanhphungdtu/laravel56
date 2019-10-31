<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const STATUS_PUBLIC = 1;
    const STATUS_PRIVATE = 0;

    const HOT_ON = 1;
    const HOT_OFF = 0;

    protected $guarded = [''];

    protected $status = [
        1 => [
            'name' => 'Public',
            'class'=> 'label-danger'
        ],
        0 =>[
            'name' =>'Private',
            'class'=>'label-default'
        ]
    ];

    protected $hot = [
        1 => [
            'name' => 'Nổi bật',
            'class'=> 'label-success'
        ],
        0 =>[
            'name' =>'Không',
            'class'=>'label-default'
        ]
    ];

    public function getStatus(){
        return array_get($this->status,$this->pro_active, '[N\A]');
    }
    public function getHot(){
        return array_get($this->hot,$this->pro_hot, '[N\A]');
    }

    public function category(){
        return $this->belongsTo(Category::class,'pro_category_id');
    }
    //list product
    public function productList($request){
        $products = Product::with('category:id,c_name');
        //tiem kiem ten sp
        if($request->name) $products->where('pro_name','like','%'.$request->name.'%');
        //tiem kiem theo danh muc
        if($request->cate)  $products->where('pro_category_id',$request->cate);
        //lay theo id , phan trang
        $products = $products->orderBy('id','DESC')->paginate(10);

        return $products;
    }

    //list category
    public function getCategories(){
        return Category::all();
    }

    //method insert va update
    public function insertOrUpdate($requestProduct, $id=''){
        $product = new Product();
        if($id) $product = $this->productId($id);

        $product->pro_name = $requestProduct->pro_name;
        $product->pro_slug = str_slug($requestProduct->pro_name);
        $product->pro_category_id = $requestProduct->pro_category_id;
        $product->pro_price = $requestProduct->pro_price;
        $product->pro_sale = $requestProduct->pro_sale;
        $product->pro_number = $requestProduct->pro_number;
        $product->pro_title_seo = $requestProduct->pro_title_seo ? $requestProduct->pro_title_seo : $requestProduct->pro_name;
        $product->pro_description_seo = $requestProduct->pro_description_seo ? $requestProduct->pro_description_seo : $requestProduct->pro_name;
        $product->pro_description = $requestProduct->pro_description;
        $product->pro_content = $requestProduct->pro_content;

        if($requestProduct->hasFile('avatar'))
        {
            $file = upload_image('avatar');
            if(isset($file['name']))
            {
                $product->pro_avatar = $file['name'];
            }
            //dd($file);
        }

        $product->save();

        return $product;
    }

    public function productId($id){
        return Product::find($id);
    }

    public function productAction($action,$id){
        if($action)
        {
            $product =  $this->productId($id);
            switch ($action)
            {
                case 'delete':
                    $product->delete();
                    $msgProduct = 'Xóa sản phẩm thành công';
                    break;

                case 'active':
                    $product->pro_active = $product->pro_active ? 0 : 1;
                    $msgProduct = 'Cập nhật sản phẩm public thành công';
                    $product->save();
                    break;
                case 'hot':
                    $product->pro_hot = $product->pro_hot ? 0 : 1;
                    $msgProduct = 'Cập nhật sản phẩm nổi bật thành công';
                    $product->save();
                    break;
            }

        }
        return $msgProduct;
    }

    public function productWarehouseList($request){
        $products = Product::with('category:id,c_name');

        $column = 'id';
        if($request->type && $request->type == 'pay'){
            $column = 'pro_pay';
            $products->where('pro_pay','>',0);
        }else{
            $products->where('pro_number','<=',5);
        }

        if($request->name) $products->where('pro_name','like','%'.$request->name.'%');
        if($request->cate)  $products->where('pro_category_id',$request->cate);

        $products = $products->orderBy($column,'DESC')->paginate(10);

        return $products;
    }
}
