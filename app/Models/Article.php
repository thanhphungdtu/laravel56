<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    const HOT = 1;

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
            'name' => 'Public',
            'class'=> 'label-success'
        ],
        0 =>[
            'name' =>'Private',
            'class'=>'label-default'
        ]
    ];

    public function getStatus(){
        return array_get($this->status,$this->a_active, '[N\A]');
    }

    public function getHot(){
        return array_get($this->hot,$this->a_hot, '[N\A]');
    }

    public function articleList($request){
        $articles = Article::whereRaw(1);
        //tiem kiem bai viet
        if($request->name) $articles->where('a_name','like','%'.$request->name.'%');

        $articles = $articles->paginate(10);
        return $articles;
    }

    public function articleId($id){
        return Article::find($id);
    }

    public function insertOrUpdate($requestArticle, $id=''){
        $article = new Article();
        if($id) $article = $this->articleId($id);

        $article->a_name = $requestArticle->a_name;
        $article->a_slug = str_slug($requestArticle->a_name);
        $article->a_description = $requestArticle->a_description;
        $article->a_content = $requestArticle->a_content;
        $article->a_title_seo = $requestArticle->a_title_seo ? $requestArticle->a_title_seo :  $requestArticle->a_name;
        $article->a_description_seo = $requestArticle->a_description_seo ?  $requestArticle->a_description_seo : $requestArticle->a_description;

        if($requestArticle->hasFile('avatar'))
        {
            $file = upload_image('avatar');
            if(isset($file['name']))
            {
                $article->a_avatar = $file['name'];
            }
            //dd($file);
        }

        $article->save();

        return $article;
    }

    public function articleAction($action, $id){
        if($action)
        {
            $article = $this->articleId($id);

            switch ($action)
            {
                case 'delete':
                    $article->delete();
                    $msgArticle = 'Xóa Bài viết thành công';
                    break;

                case 'active':
                    $article->a_active = $article->a_active ? 0 : 1;
                    $article->save();
                    $msgArticle = 'Cập nhật trạng thái Bài viết thành công';
                    break;
                case 'hot':
                    $article->a_hot = $article->a_hot ? 0 : 1;
                    $msgArticle = 'Cập nhật nổi bật Bài viết thành công';
                    $article->save();
                    break;
            }
        }

        return $msgArticle;
    }
}
