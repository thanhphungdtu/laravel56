<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $guarded = [''];

    const STATUS_PUBLIC = 1;
    const STATUS_PRIVATE = 0;

    const HOME = 1;

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

    protected $home = [
        1 => [
            'name' => 'Public',
            'class'=> 'label-success'
        ],
        0 =>[
            'name' =>'Private',//ẩn
            'class'=>'label-default'
        ]
    ];

    public function getStatus(){
        return array_get($this->status,$this->c_active, '[N\A]');
    }

    public function getHome(){
        return array_get($this->home,$this->c_home, '[N\A]');
    }

    public function products(){
        return $this->hasMany(Product::class,'pro_category_id');
    }

    public function categoryList(){
        return Category::select('id','c_title_seo','c_name','c_active','c_home','parent_id')->get();
    }

    public function categoryStore($requestCategory){
        $category                    = new Category();
        $category->c_name            = $requestCategory->name;
        $category->c_slug            = str_slug($requestCategory->name);
        $category->c_icon            = $requestCategory->icon;
        $category->c_title_seo       = $requestCategory->c_title_seo ? $requestCategory->c_title_seo : $requestCategory->name;
        $category->c_description_seo = $requestCategory->c_description_seo;
        $category->parent_id         = $requestCategory->sltParent;
        $category->save();
        return $category;
    }

    public function categoryID($id){
        return Category::find($id);
    }

    public function categoryUpdate($requestCategory,$id){
        $category                    = Category::find($id);
        $category->c_name            = $requestCategory->name;
        $category->c_slug            = str_slug($requestCategory->name);
        $category->c_icon            = $requestCategory->icon;
        $category->c_title_seo       = $requestCategory->c_title_seo ? $requestCategory->c_title_seo : $requestCategory->name;
        $category->c_description_seo = $requestCategory->c_description_seo;
        $category->parent_id         = $requestCategory->sltParent;
        $category->save();
        return $category;
    }

    public function categoryAction($action, $id){
        if($action)
        {
            $category = Category::find($id);

            switch ($action)
            {
                case 'delete':
                    $category->delete();
                    $msgCate = 'Xóa danh mục thành công';
                    break;
                case 'home':
                    $category->c_home = $category->c_home == 1 ? 0 : 1 ;
                    $category->save();
                    $msgCate = 'Cập nhật trang chủ danh mục thành công';
                    break;
                case 'active':
                    $category->c_active = $category->c_active == 1 ? 0 : 1 ;
                    $category->save();
                    $msgCate = 'Cập nhật trạng thái danh mục thành công';
                    break;
            }
        }
        return $msgCate;
    }
}
