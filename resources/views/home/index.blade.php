@extends('layouts.app')
@section('content')
    <style>
        .first-sale {
             margin-bottom: 10px;
             margin-top: 20px;
        }
        .cat-rating .rating_active{
            color: #ff9705;
        }
        .cat-rating .active{
            color: #ff9705;
        }
    </style>
 <!-- start home slider -->
<div class="slider-area an-1 hm-1">
    <!-- slider -->
    <div class="bend niceties preview-2">
        <div id="ensign-nivoslider" class="slides">
            <img src="{{ getenv('public_url') }}img/slider/home-1/slide4.png" alt="" title="#slider-direction-1"  />
            <img src="{{ getenv('public_url') }}img/slider/home-1/slide5.png" alt="" title="#slider-direction-2"  />
            <img src="{{ getenv('public_url') }}img/slider/home-1/slide6.png" alt="" title="#slider-direction-2"  />
        </div>
        <!-- direction 1 -->
    </div>
    <!-- slider end-->
</div>
<!-- end home slider -->
<div id="product_view">

</div>
<!-- product section start -->
<div class="our-product-area new-product">
    <div class="container">
        <div class="area-title">
            <h2>Sản phẩm nổi bật</h2>
        </div>
        <!-- our-product area start -->
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="features-curosel">
                        <!-- single-product start -->
                        @if(isset($productHot))
                            @foreach($productHot as $arHot)

                        <div class="col-lg-12 col-md-12">
                            <div class="single-product first-sale">
                                <div class="product-img">
                                    @if($arHot->pro_number == 0)
                                    <span style="position: absolute;background: #e91e63; color: white;padding: 2px 6px;border-radius: 5px;font-size: 10px;">Tạm hết hàng</span>
                                    @endif
                                    @if($arHot->pro_sale)
                                    <span style="position: absolute;font-size:12px;background-image: linear-gradient(-90deg,#ec1f1f 0%,#ff9c00 100%);border-radius: 10px; padding: 1px 7px; right: 0;">Sale {{$arHot->pro_sale}}%</span>
                                    @endif
                                    <a href="{{ route('get.detail.product',[$arHot->pro_slug,$arHot->id]) }}">
                                        <img class="primary-image" src="{{ pare_url_file($arHot->pro_avatar) }}" alt=""/>
                                        <img class="secondary-image" src="{{ pare_url_file($arHot->pro_avatar) }}" alt=""  />
                                    </a>
                                    <div class="action-zoom">
                                        <div class="add-to-cart">
                                            <a href="{{ route('get.detail.product',[$arHot->pro_slug,$arHot->id]) }}" title="Quick View"><i class="fa fa-search-plus"></i></a>
                                        </div>
                                    </div>
                                    <div class="actions">
                                        <div class="action-buttons">
                                            <div class="add-to-links">
                                                <div class="add-to-wishlist">
                                                    <a href="#" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
                                                </div>
                                                <div class="compare-button">
                                                    <a href="{{ route('add.shopping.cart',[$arHot->id]) }}" title="Add to Cart"><i class="icon-bag"></i></a>
                                                </div>
                                            </div>
                                            <div class="quickviewbtn">
                                                <a href="{{ route('get.detail.product',[$arHot->pro_slug,$arHot->id]) }}" title="Add to Compare"><i class="fa fa-retweet"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="price-box">
                                        <span class="new-price">{{ number_format($arHot->pro_price,0,',','.') }} đ</span>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h2 class="product-name"><a href="{{ route('get.detail.product',[$arHot->pro_slug,$arHot->id]) }}">{{ $arHot->pro_name }}</a></h2>
                                    <p style="overflow: hidden;text-overflow: ellipsis;line-height: 25px;-webkit-line-clamp: 3; height: 75px; display: -webkit-box;-webkit-box-orient: vertical;">{{ $arHot->pro_description }}</p>
                                </div>
                            </div>
                        </div>
                            @endforeach
                        @endif
                        <!-- single-product end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- our-product area end -->
    </div>
</div>
<!-- product section end -->
 <div class="our-product-area new-product">
     <div class="container">
         <div class="area-title">
             <h2>Sản phẩm mới nhất</h2>
         </div>
         <!-- our-product area start -->
         <div class="row">
             <div class="col-md-12">
                 <div class="row">
                     <div class="features-curosel">
                         @if(isset($productNews))
                             @foreach($productNews as $productNew)
                                 <div class="col-lg-12 col-md-12">
                                     <div class="single-product first-sale">
                                         <div class="product-img">
                                             @if($productNew->pro_number == 0)
                                                 <span style="position: absolute;background: #e91e63; color: white;padding: 2px 6px;border-radius: 5px;font-size: 10px;">Tạm hết hàng</span>
                                             @endif
                                             @if($productNew->pro_sale)
                                                 <span style="position: absolute;font-size:12px;background-image: linear-gradient(-90deg,#ec1f1f 0%,#ff9c00 100%);border-radius: 10px; padding: 1px 7px; right: 0;">Sale {{$productNew->pro_sale}}%</span>
                                             @endif
                                             <a href="{{ route('get.detail.product',[$productNew->pro_slug,$productNew->id]) }}">
                                                 <img class="primary-image" src="{{ pare_url_file($productNew->pro_avatar) }}" alt="" />
                                                 <img class="secondary-image" src="{{ pare_url_file($productNew->pro_avatar) }}" alt="" />
                                             </a>
                                             <div class="action-zoom">
                                                 <div class="add-to-cart">
                                                     <a href="{{ route('get.detail.product',[$productNew->pro_slug,$productNew->id]) }}" title="Quick View"><i class="fa fa-search-plus"></i></a>
                                                 </div>
                                             </div>
                                             <div class="actions">
                                                 <div class="action-buttons">
                                                     <div class="add-to-links">
                                                         <div class="add-to-wishlist">
                                                             <a href="#" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
                                                         </div>
                                                         <div class="compare-button">
                                                             <a href="{{ route('add.shopping.cart',[$productNew->id]) }}" title="Add to Cart"><i class="icon-bag"></i></a>
                                                         </div>
                                                     </div>
                                                     <div class="quickviewbtn">
                                                         <a href="{{ route('get.detail.product',[$productNew->pro_slug,$productNew->id]) }}" title="Add to Compare"><i class="fa fa-retweet"></i></a>
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="price-box">
                                                 <span class="new-price">{{ number_format($productNew->pro_price,0,',','.') }} đ</span>
                                             </div>
                                         </div>
                                         <div class="product-content">
                                             <h2 class="product-name"><a href="{{ route('get.detail.product',[$productNew->pro_slug,$productNew->id]) }}">{{ $productNew->pro_name }}</a></h2>
                                             <p style="overflow: hidden;text-overflow: ellipsis;line-height: 25px;-webkit-line-clamp: 3; height: 75px; display: -webkit-box;-webkit-box-orient: vertical;">{{ $productNew->pro_description }}</p>
                                         </div>
                                     </div>
                                 </div>
                             @endforeach
                         @endif
                     </div>
                 </div>
             </div>
         </div>
         <!-- our-product area end -->
     </div>
 </div>
<!-- latestpost area start -->
 @if(isset($articleNews))
<div class="latest-post-area">
    <div class="container">
        <div class="area-title">
            <h2>Bài viết mới</h2>
        </div>
        <div class="row">
            <div class="all-singlepost">
                <!-- single latestpost start -->
                @foreach($articleNews as $arNews)
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="single-post">
                        <div class="post-thumb">
                            <a href="{{ route('get.detail.article',[$arNews->a_slug,$arNews->id]) }}">
                                <img src="{{ asset(pare_url_file($arNews->a_avatar)) }}" alt="" />
                            </a>
                        </div>
                        <div class="post-thumb-info">
                            <div class="post-time">
                                <a href="#">Beauty</a>
                                <span>/</span>
                                <span>Post by</span>
                                <span>BootExperts</span>
                            </div>
                            <div class="postexcerpt">
                                <p>{{ $arNews->a_name }}</p>
                                <a href="{{ route('get.detail.article',[$arNews->a_slug,$arNews->id]) }}" class="read-more">Xem thêm</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- single latestpost end -->
            </div>
        </div>
    </div>
</div>
@endif
<!-- latestpost area end -->
<!-- block category area start -->
<div class="block-category">
    <div class="container">
        <div class="row">
            <!-- featured block start -->
            @if(isset($categoriesHome))
                @foreach($categoriesHome as $categorieHome)
                    <div class="col-md-4">
                    <!-- block title start -->
                    <div class="block-title">
                        <h2>{{ $categorieHome->c_name }}</h2>
                    </div>
                    <!-- block title end -->
                    <!-- block carousel start -->
                    @if(isset($categorieHome->products))
                        <div class="block-carousel">
                            @foreach($categorieHome->products as $product)
                                <?php
                                    $ageDetail = 0;
                                    if($product->pro_total_rating){
                                        $ageDetail = round($product->pro_total_number / $product->pro_total_rating,2);
                                    }
                                ?>
                            <div class="block-content">
                                <!-- single block start -->
                                <div class="single-block">
                                    <div class="block-image pull-left">
                                        <a href="{{ route('get.detail.product',[$product->pro_slug,$product->id]) }}"><img src="{{ pare_url_file($product->pro_avatar) }}" alt="" style="width: 180px; height: 170px;" /></a>
                                    </div>
                                    <div class="category-info">
                                        <h3 style="text-overflow: ellipsis;white-space: nowrap; overflow: hidden;"><a href="{{ route('get.detail.product',[$product->pro_slug,$arNews->id]) }}">{{ $product->pro_name }}</a></h3>
                                        <p style="overflow: hidden;text-overflow: ellipsis;-webkit-line-clamp: 2; height: 45px; display: -webkit-box;-webkit-box-orient: vertical;" >{{ $product->pro_description }}</p>
                                        <?php
                                            $priceSale = $product->pro_price * (100 - $product->pro_sale )/ 100;
                                        ?>
                                        <div class="cat-price" style="margin-bottom: 5px;">{{ number_format($product->pro_price,0,',','.') }}đ<span class="old-price">{{ number_format($priceSale,0,',','.') }}</span></div>
                                        <div class="cat-rating">
                                            @for($i =1; $i <= 5; $i++)
                                                <a href="#"><i class="fa fa-star {{ $i <= $ageDetail ? 'active' : '' }}"></i></a>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <!-- single block end -->
                            </div>
                            @endforeach
                        </div>
                    @endif
                    <!-- block carousel end -->
                </div>
                @endforeach
            @endif
            <!-- featured block end -->
        </div>
    </div>
</div>
<!-- block category area end -->
<!-- testimonial area start -->
<div class="testimonial-area lap-ruffel">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="crusial-carousel">
                    <div class="crusial-content">
                        <p>“Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat."</p>
                        <span>BootExperts</span>
                    </div>
                    <div class="crusial-content">
                        <p>“Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat."</p>
                        <span>Lavoro Store!</span>
                    </div>
                    <div class="crusial-content">
                        <p>“Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat."</p>
                        <span>MR Selim Rana</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- testimonial area end -->
<!-- Brand Logo Area Start -->
<div class="brand-area">
    <div class="container">
        <div class="row">
                <div class="brand-item"><a href="#"><img src="{{ getenv('public_url') }}img/brand/bank.png" alt="" /></a></div>
        </div>
    </div>
</div>
<!-- Brand Logo Area End -->   
@endsection
@section('script')
    <script>
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let routeRenderProduct = '{{ route('post.product.view') }}';
            checkRenderProduct = false;

            $(document).on('scroll',function () {
                if ($(window).scrollTop() > 150 && checkRenderProduct == false){

                    //console.log("LOG");
                    checkRenderProduct = true;
                    let products = localStorage.getItem('products');
                    products = $.parseJSON(products);

                    if(products.length > 0)
                    {
                        $.ajax({
                            url: routeRenderProduct,
                            method: "POST",
                            data: { id: products},
                            success: function (result) {
                                $("#product_view").html('').append(result.data)
                            }
                        });
                    }
                }
            });
        })
    </script>
@stop