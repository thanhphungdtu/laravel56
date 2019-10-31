<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getListArticle(){
        $articles = Article::simplePaginate(3);//tốc độ nhanh hơn

        $articlesHot = Article::where('a_hot',Article::HOT)->get();

        return view('article.index',compact('articles','articlesHot'));
    }

    public function getDetailArticle(Request $request){
        $arrayUrl = preg_split('/(-)/i',$request->segment(2));

        $id = array_pop($arrayUrl);//lay id

        if ($id)
        {
            $articleDetail = Article::find($id);
            $articles = Article::where('id','!=',$id)->limit(3)->get();

            $articlesHot = Article::where('a_hot',Article::HOT)->get();

            $viewData = [
                'articleDetail' => $articleDetail,
                'articles' => $articles,
                'articlesHot' => $articlesHot
            ];

            return view('article.detail',$viewData);
        }
        return redirect('/');
    }
}
