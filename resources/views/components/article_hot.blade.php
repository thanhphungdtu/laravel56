@if(isset($articlesHot))
    @foreach($articlesHot as $articleHot)
        <div class="article_hot_item">
            <div class="article_img">
                <a href="">
                    <img src="{{ pare_url_file($articleHot->a_avatar) }}" alt="">
                </a>
            </div>
            <div class="article_info">
                <h3 style="font-size: 15px;margin-top: 10px;margin-bottom: 10px;">{{ $articleHot->a_name }}</h3>
                <p>{{ $articleHot->a_description }}</p>
            </div>
        </div>
    @endforeach
@endif
