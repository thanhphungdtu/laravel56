<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Requests\RequestArticle;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class AdminArticleController extends Controller
{
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function index(Request $request){
       $articles =  $this->article->articleList($request);

       $viewData = [
           'articles'=> $articles
       ];
       return view('admin::article.index',$viewData);
   }

   public function create(){
        return view('admin::article.create');
   }

   public function store(RequestArticle $requestArticle){
        $this->article->insertOrUpdate($requestArticle);
        return redirect()->route('admin.get.list.article');
   }

   public function edit($id){
        $article = $this->article->articleId($id);
       return view('admin::article.create',compact('article'));
   }

   public function update(RequestArticle $requestArticle,$id){
       $this->article->insertOrUpdate($requestArticle,$id);
       return redirect()->route('admin.get.list.article');
   }

    public function action($action,$id){
        $msgArticle = $this->article->articleAction($action,$id);
        return redirect()->back()->with('success',$msgArticle);
    }
}
