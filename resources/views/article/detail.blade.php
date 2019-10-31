@extends('layouts.app')
@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="container-inner">
                        <ul>
                            <li class="home">
                                <a href="/">Trang chủ</a>
                                <span><i class="fa fa-angle-right"></i></span>
                            </li>
                            <li class="home">
                                <a href="{{ route('get.list.article') }}">Bài viết</a>
                                <span><i class="fa fa-angle-right"></i></span>
                            </li>
                            <li class="category3"><span>{{ $articleDetail->a_name }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-contact-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="article_content" style="margin-bottom: 20px;">
                        <h3 style="color: #666666">{{ $articleDetail->a_name }}</h3>
                        <p>{{ $articleDetail->a_description }}</p>
                        <div  style="font-weight: 300;color: #666">
                            {!! $articleDetail->a_content  !!}
                        </div>
                    </div>
                    <h4 style="color: #666">Bài viết khác</h4>
                    @if($articles)
                        @foreach($articles as $article)
                            <div class="article" style="padding: 20px 0;margin: 10px;border-bottom: 1px solid #f2f2f2; display: flex;">
                                <div class="article_avatar">
                                    <a href="{{ route('get.detail.article',[$article->a_slug,$article->id]) }}">
                                        <img src="{{ pare_url_file($article->a_avatar) }}" alt="" style="width: 200px;height: 120px;">
                                    </a>
                                </div>
                                <div class="article_info" style="width: 80%; margin-left: 20px;">
                                    <h2 style="font-size: 14px"><a href="{{ route('get.detail.article',[$article->a_slug,$article->id]) }}">{{ $article->a_name }}</a></h2>
                                    <p style="font-size: 13px">{{ $article->a_description }}</p>
                                    <p>Admin <span>{{ $article->created_at }}</span></p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="col-sm-3">
                    <h2 style="font-size: 14px;color: orangered;">Bài viết nổi bật</h2>
                    <div class="list_article_hot">
                        @include('components.article_hot')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection