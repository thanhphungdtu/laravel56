@extends('layouts.app')
@section('content')
    <style>
        .sidebar-content .active{
            color: #c2a476;
        }
    </style>
        <!-- breadcrumbs area start -->
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
                                @if(isset($cateProduct->c_name))
                                <li class="category3"><span>{{ $cateProduct->c_name }}</span></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumbs area end -->
        <!-- shop-with-sidebar Start -->
        <div class="shop-with-sidebar">
            <div class="container">
                <div class="row">
                    <!-- left sidebar start -->
                    <div class="col-md-3 col-sm-12 col-xs-12 text-left">
                        <div class="topbar-left">
                            <aside class="widge-topbar">
                                <div class="bar-title">
                                    <div class="bar-ping"><img src="{{ getenv('public_url') }}img/bar-ping.png" alt=""></div>
                                    <h2 style="font-size: 18px;">Tìm kiếm sản phẩm</h2>
                                </div>
                            </aside>
                            <aside class="sidebar-content">
                                <div class="sidebar-title">
                                    <h6>Khoảng giá</h6>
                                </div>
                                <ul>
                                    <li><a class="{{ Request::get('price') == 1 ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['price' => '1']) }}"> < Dưới 1 triệu</a></li>
                                    <li><a class="{{ Request::get('price') == 2 ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['price' => '2']) }}"> 1.000.000 - 3.000.000 đ</a></li>
                                    <li><a class="{{ Request::get('price') == 3 ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['price' => '3']) }}"> 3.000.000 - 5.000.000 đ</a></li>
                                    <li><a class="{{ Request::get('price') == 4 ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['price' => '4']) }}"> 5.000.000 - 7.000.000 đ</a></li>
                                    <li><a class="{{ Request::get('price') == 5 ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['price' => '5']) }}"> 7.000.000 - 10.000.000 đ</a></li>
                                    <li><a class="{{ Request::get('price') == 6 ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['price' => '6']) }}"> Trên 10 triệu ></a></li>
                                </ul>
                            </aside>
                            <aside class="widge-topbar">
                                <div class="bar-title">
                                    <div class="bar-ping"><img src="{{ getenv('public_url') }}img/bar-ping.png" alt=""></div>
                                    <h2>Tags</h2>
                                </div>
                                <div class="exp-tags">
                                    <div class="tags">
                                        <a href="#">Loa</a>
                                        <a href="#">Máy lạnh</a>
                                        <a href="#">Điều hòa</a>
                                        <a href="#">Giá rẻ</a>
                                        <a href="#">Tủ lạnh</a>
                                        <a href="#">Tablet</a>
                                        <a href="#">Đồ cũ</a>
                                        <a href="#">Tivi</a>
                                    </div>
                                </div>
                            </aside>
                        </div>
                    </div>
                    <!-- left sidebar end -->
                    <!-- right sidebar start -->
                    <div class="col-md-9 col-sm-12 col-xs-12">
                        <!-- shop toolbar start -->
                        <div class="shop-content-area">
                            <div class="shop-toolbar">
                                <div class="col-xs-12 nopadding-left">
                                    <form class="tree-most" id="form_order" method="get">
                                        @csrf
                                        <div class="orderby-wrapper pull-right">
                                            <label>Sắp xếp</label>
                                            <select name="orderby" class="orderby">
                                                <option {{ Request::get('orderby') == "md"  ? "selected='selected'" : "" }} value="md" selected="selected">Mặc định</option>
                                                <option {{ Request::get('orderby') == "desc" ? "selected='selected'" : "" }} value="desc">Mới nhất</option>
                                                <option {{ Request::get('orderby') == "asc" ? "selected='selected'" : "" }} value="asc">Sản phẩm cũ</option>
                                                <option {{ Request::get('orderby') == "price_max" ? "selected='selected'" : "" }} value="price_max">Giá thấp đến cao</option>
                                                <option {{ Request::get('orderby') == "price_min" ? "selected='selected'" : "" }} value="price_min">Giá cao đến thấp</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- shop toolbar end -->
                        <!-- product-row start -->
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="shop-grid-tab">
                                <div class="row">
                                    <div class="shop-product-tab first-sale">
                                        @foreach($products as $product)
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="two-product">
                                                <!-- single-product start -->
                                                <div class="single-product">
                                                   {{-- <span class="sale-text">Sale</span>--}}
                                                    <div class="product-img">
                                                        @if($product->pro_number == 0)
                                                            <span style="position: absolute;background: #e91e63; color: white;padding: 2px 6px;border-radius: 5px;font-size: 10px;">Tạm hết hàng</span>
                                                        @endif
                                                        @if($product->pro_sale)
                                                            <span style="position: absolute;font-size:12px;background-image: linear-gradient(-90deg,#ec1f1f 0%,#ff9c00 100%);border-radius: 10px; padding: 1px 7px; right: 0;">Sale {{$product->pro_sale}}%</span>
                                                        @endif
                                                        <a href="{{ route('get.detail.product',[$product->pro_slug,$product->id]) }}">
                                                            <img class="primary-image" src="{{ asset(pare_url_file($product->pro_avatar)) }}" alt="" />
                                                            <img class="secondary-image" src="{{ asset(pare_url_file($product->pro_avatar)) }}" alt="" />
                                                        </a>
                                                        <div class="action-zoom">
                                                            <div class="add-to-cart">
                                                                <a href="{{ route('get.detail.product',[$product->pro_slug,$product->id]) }}" title="Quick View"><i class="fa fa-search-plus"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="actions">
                                                            <div class="action-buttons">
                                                                <div class="add-to-links">
                                                                    <div class="add-to-wishlist">
                                                                        <a href="#" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
                                                                    </div>
                                                                    <div class="compare-button">
                                                                        <a href="{{ route('add.shopping.cart',[$product->id]) }}" title="Add to Cart"><i class="icon-bag"></i></a>
                                                                    </div>                                  
                                                                </div>
                                                                <div class="quickviewbtn">
                                                                    <a href="#" title="Add to Compare"><i class="fa fa-retweet"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="price-box">
                                                            <span class="new-price">{{ number_format($product->pro_price,0,',','.') }}đ</span>
                                                        </div>
                                                    </div>
                                                    <div class="product-content">
                                                        <h2 class="product-name"><a href="{{ route('get.detail.product',[$product->pro_slug,$product->id]) }}">{{ $product->pro_name }}</a></h2>
                                                        <p  style="overflow: hidden;text-overflow: ellipsis;line-height: 25px;-webkit-line-clamp: 3; height: 75px; display: -webkit-box;-webkit-box-orient: vertical;">{{ $product->pro_description }}</p>
                                                    </div>
                                                </div>
                                                <!-- single-product end -->
                                            </div>
                                        </div>
                                         @endforeach
                                    </div>
                                </div>
                                <!-- product-row end -->
                            </div>
                            <!-- list view -->
                            <!-- shop toolbar start -->
                            <div class="shop-content-bottom">
                                <div class="shop-toolbar btn-tlbr">
                                    <div class="col-md-4 col-sm-4 col-xs-12 text-center">
                                        <div class="pages">
                                            {!! $products->appends($query)->links() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- shop toolbar end -->
                        </div>
                    </div>
                    <!-- right sidebar end -->
                </div>
            </div>
        </div>
        <!-- shop-with-sidebar end -->
        <!-- Brand Logo Area Start -->
        <div class="brand-area">
            <div class="container">
                <div class="row">
                    <div class="brand-carousel">
                        <div class="brand-item"><a href="#"><img src="{{ getenv('public_url') }}img/brand/bg1-brand.jpg" alt="" /></a></div>
                        <div class="brand-item"><a href="#"><img src="{{ getenv('public_url') }}img/brand/bg2-brand.jpg" alt="" /></a></div>
                        <div class="brand-item"><a href="#"><img src="{{ getenv('public_url') }}img/brand/bg3-brand.jpg" alt="" /></a></div>
                        <div class="brand-item"><a href="#"><img src="{{ getenv('public_url') }}img/brand/bg4-brand.jpg" alt="" /></a></div>
                        <div class="brand-item"><a href="#"><img src="{{ getenv('public_url') }}img/brand/bg5-brand.jpg" alt="" /></a></div>
                        <div class="brand-item"><a href="#"><img src="{{ getenv('public_url') }}img/brand/bg2-brand.jpg" alt="" /></a></div>
                        <div class="brand-item"><a href="#"><img src="{{ getenv('public_url') }}img/brand/bg3-brand.jpg" alt="" /></a></div>
                        <div class="brand-item"><a href="#"><img src="{{ getenv('public_url') }}img/brand/bg4-brand.jpg" alt="" /></a></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Brand Logo Area End -->
@endsection

@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function () {
            $('.orderby').change(function () {//bắt sự kiên
                $("#form_order").submit();
            })
        })
        
    </script>
@stop