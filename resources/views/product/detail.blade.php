@extends('layouts.app')
@section('content')
	<style>
		img.lazy {
			width: 100% !important;
		}
		.area_article img {
			display: block;
			width: 100%;
			max-width: 100%;
			height: auto;
			margin: 15px auto 5px;
		}
		.list_start i:hover{
			cursor: pointer;
		}
		.list_text{
			display: inline-block;
			margin-left: 10px;
			position: relative;
			background: #52b858;
			color: #fff;
			padding: 2px 8px;
			box-sizing: border-box;
			font-size: 12px;
			border-radius: 2px;
			display: none;
		}
		.list_text:after{
			right: 100%;
			top: 50%;
			border: solid transparent;
			content: "";
			height: 0;
			width: 0;
			position: absolute;
			pointer-events: none;
			border-color: rgba(82,184,88,0);
			border-right-color: #52b858;
			border-width: 6px;
			margin-top: -6px;
		}
		.list_start .rating_active{
			color: #ff9705;
		}
		.pro-rating .active{
			color: #ff9705;
		}
	</style>
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="container-inner">
						<ul>

							<li class="home">
								<a href="">Trang chủ</a>
								<span><i class="fa fa-angle-right"></i></span>
							</li>
							<li class="home">
								<a href="">{{ $cateProduct->c_name }}</a>
								<span><i class="fa fa-angle-right"></i></span>
							</li>
							<li class="category3"><span>{{ $productDetail->pro_name }}</span></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="product-details-area" id="content_product" data-id="{{$productDetail->id}}">
		<div class="container">
			<div class="row">
				<div class="col-md-5 col-sm-5 col-xs-12">
					<div class="zoomWrapper">
						<div id="img-1" class="zoomWrapper single-zoom">
							<a href="#">
								<div style="height:450px;width:450px;" class="zoomWrapper"><img id="zoom1" src="{{ pare_url_file($productDetail->pro_avatar) }}" data-zoom-image="{{ pare_url_file($productDetail->pro_avatar) }}" alt="big-1" style="position: absolute;"></div>
							</a>
						</div>
						{{--<div class="single-zoom-thumb">
							<div class="bx-wrapper" style="max-width: 365px;">
								<div class="bx-viewport" aria-live="polite" style="width: 100%; overflow: hidden; position: relative; height: 83px;">
									<ul class="bxslider" id="gallery_01" style="width: 8215%; position: relative; transition-duration: 0s; transform: translate3d(-380px, 0px, 0px);">
										<li class="bx-clone" style="float: left; list-style: none; position: relative; width: 80px; margin-right: 15px;" aria-hidden="true">
											<a href="#" class="elevatezoom-gallery" data-image="img/product-details/big-5.jpg" data-zoom-image="img/product-details/ex-big-5.jpg"><img src="img/product-details/th-5.jpg" alt="zo-th-5"></a>
										</li>
										<li class="bx-clone" style="float: left; list-style: none; position: relative; width: 80px; margin-right: 15px;" aria-hidden="true">
											<a href="#" class="elevatezoom-gallery" data-image="img/product-details/big-6.jpg" data-zoom-image="img/product-details/ex-big-6.jpg"><img src="img/product-details/th-6.jpg" alt="ex-big-3"></a>
										</li>
										<li class="bx-clone" style="float: left; list-style: none; position: relative; width: 80px; margin-right: 15px;" aria-hidden="true">
											<a href="#" class="elevatezoom-gallery" data-image="img/product-details/big-7.jpg" data-zoom-image="img/product-details/ex-big-7.jpg"><img src="img/product-details/th-7.jpg" alt="ex-big-3"></a>
										</li>
										<li class="bx-clone" style="float: left; list-style: none; position: relative; width: 80px; margin-right: 15px;" aria-hidden="true">
											<a href="#" class="elevatezoom-gallery" data-image="img/product-details/big-8.jpg" data-zoom-image="img/product-details/ex-big-8.jpg"><img src="img/product-details/th-8.jpg" alt="ex-big-3"></a>
										</li>
										<li style="float: left; list-style: none; position: relative; width: 80px; margin-right: 15px;" aria-hidden="false">
											<a href="#" class="elevatezoom-gallery active" data-update="" data-image="img/product-details/big-1-1.jpg" data-zoom-image="img/product-details/ex-big-1-1.jpg"><img src="img/product-details/th-1-1.jpg" alt="zo-th-1"></a>
										</li>
										<li class="" style="float: left; list-style: none; position: relative; width: 80px; margin-right: 15px;" aria-hidden="false">
											<a href="#" class="elevatezoom-gallery" data-image="img/product-details/big-1-2.jpg" data-zoom-image="img/product-details/ex-big-1-2.jpg"><img src="img/product-details/th-1-2.jpg" alt="zo-th-2"></a>
										</li>
										<li class="" style="float: left; list-style: none; position: relative; width: 80px; margin-right: 15px;" aria-hidden="false">
											<a href="#" class="elevatezoom-gallery" data-image="img/product-details/big-1-3.jpg" data-zoom-image="img/product-details/ex-big-1-3.jpg"><img src="img/product-details/th-1-3.jpg" alt="ex-big-3"></a>
										</li>
										<li class="" style="float: left; list-style: none; position: relative; width: 80px; margin-right: 15px;" aria-hidden="true">
											<a href="#" class="elevatezoom-gallery" data-image="img/product-details/big-4.jpg" data-zoom-image="img/product-details/ex-big-4.jpg"><img src="img/product-details/th-4.jpg" alt="zo-th-4"></a>
										</li>
										<li class="" style="float: left; list-style: none; position: relative; width: 80px; margin-right: 15px;" aria-hidden="true">
											<a href="#" class="elevatezoom-gallery" data-image="img/product-details/big-5.jpg" data-zoom-image="img/product-details/ex-big-5.jpg"><img src="img/product-details/th-5.jpg" alt="zo-th-5"></a>
										</li>
										<li class="" style="float: left; list-style: none; position: relative; width: 80px; margin-right: 15px;" aria-hidden="true">
											<a href="#" class="elevatezoom-gallery" data-image="img/product-details/big-6.jpg" data-zoom-image="img/product-details/ex-big-6.jpg"><img src="img/product-details/th-6.jpg" alt="ex-big-3"></a>
										</li>
										<li class="" style="float: left; list-style: none; position: relative; width: 80px; margin-right: 15px;" aria-hidden="true">
											<a href="#" class="elevatezoom-gallery" data-image="img/product-details/big-7.jpg" data-zoom-image="img/product-details/ex-big-7.jpg"><img src="img/product-details/th-7.jpg" alt="ex-big-3"></a>
										</li>
										<li class="" style="float: left; list-style: none; position: relative; width: 80px; margin-right: 15px;" aria-hidden="true">
											<a href="#" class="elevatezoom-gallery" data-image="img/product-details/big-8.jpg" data-zoom-image="img/product-details/ex-big-8.jpg"><img src="img/product-details/th-8.jpg" alt="ex-big-3"></a>
										</li>
										<li style="float: left; list-style: none; position: relative; width: 80px; margin-right: 15px;" class="bx-clone" aria-hidden="true">
											<a href="#" class="elevatezoom-gallery active" data-update="" data-image="img/product-details/big-1-1.jpg" data-zoom-image="img/product-details/ex-big-1-1.jpg"><img src="img/product-details/th-1-1.jpg" alt="zo-th-1"></a>
										</li>
										<li class="bx-clone" style="float: left; list-style: none; position: relative; width: 80px; margin-right: 15px;" aria-hidden="true">
											<a href="#" class="elevatezoom-gallery" data-image="img/product-details/big-1-2.jpg" data-zoom-image="img/product-details/ex-big-1-2.jpg"><img src="img/product-details/th-1-2.jpg" alt="zo-th-2"></a>
										</li>
										<li class="bx-clone" style="float: left; list-style: none; position: relative; width: 80px; margin-right: 15px;" aria-hidden="true">
											<a href="#" class="elevatezoom-gallery" data-image="img/product-details/big-1-3.jpg" data-zoom-image="img/product-details/ex-big-1-3.jpg"><img src="img/product-details/th-1-3.jpg" alt="ex-big-3"></a>
										</li>
										<li class="bx-clone" style="float: left; list-style: none; position: relative; width: 80px; margin-right: 15px;" aria-hidden="true">
											<a href="#" class="elevatezoom-gallery" data-image="img/product-details/big-4.jpg" data-zoom-image="img/product-details/ex-big-4.jpg"><img src="img/product-details/th-4.jpg" alt="zo-th-4"></a>
										</li>
									</ul>
								</div>
								<div class="bx-controls bx-has-controls-direction">
									<div class="bx-controls-direction"><a class="bx-prev" href="">Prev</a><a class="bx-next" href="">Next</a></div>
								</div>
							</div>
						</div>--}}
					</div>
				</div>
				<div class="col-md-7 col-sm-7 col-xs-12">
					<div class="product-list-wrapper">
						<div class="single-product">
							<div class="product-content">
								<h2 class="product-name"><a href="#">{{ $productDetail->pro_name }}</a></h2>
								<div class="rating-price">
									<div class="pro-rating">
                                        <?php
											$ageDetail = 0;
											if($productDetail->pro_total_rating){
                                                $ageDetail = round($productDetail->pro_total_number / $productDetail->pro_total_rating,2);
											}
                                        ?>
										@for($i =1; $i <= 5; $i++)
										<a href="#"><i class="fa fa-star {{ $i <= $ageDetail ? 'active' : '' }}"></i></a>
										@endfor
									</div>
									<div class="price-boxes">
										<span class="new-price">{{ number_format($productDetail->pro_price,0,',','.') }} đ</span>
									</div>
								</div>
								<div class="product-desc">
									<p>{{ $productDetail->pro_description }}</p>
								</div>
								<p class="availability in-stock">Availability: <span>In stock</span></p>
								<div class="actions-e">
									<div class="action-buttons-single">
										<div class="inputx-content">
											<label for="qty">Quantity:</label>
											<input type="text" name="qty" id="qty" maxlength="12" value="1" title="Qty" class="input-text qty">
										</div>
										<div class="add-to-cart">
											<a href="{{ route('add.shopping.cart',[$productDetail->id]) }}">Add to cart</a>
										</div>
										<div class="add-to-links">
											<div class="add-to-wishlist">
												<a href="#" data-toggle="tooltip" title="" data-original-title="Add to Wishlist"><i class="fa fa-heart"></i></a>
											</div>
											<div class="compare-button">
												<a href="#" data-toggle="tooltip" title="" data-original-title="Compare"><i class="fa fa-refresh"></i></a>
											</div>
										</div>
									</div>
								</div>
								<div class="singl-share">
									<a href="#"><img src="{{ getenv('public_url') }}img/single-share.png" alt=""></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="single-product-tab">
					<!-- Nav tabs -->
					<ul class="details-tab">
						<li class="active"><a href="" data-toggle="tab">Chi tiết sản phẩm</a></li>
						<li class=""><a href="#" data-toggle="tab">Đánh giá</a></li>
					</ul>
					<!-- Tab panes -->

					<div class="tab-content" style="margin-bottom: 30px;">
						<div role="tabpanel" class="tab-pane active" id="home">
							<div class="product-tab-content">
								{!! $productDetail->pro_content !!}
							</div>
						</div>
						<div class="clr" style="border-top: 1px solid #dedede;margin-bottom: 20px; margin-top: 20px;"></div>
						<div class="component_rating" style="margin-bottom: 10px;">
							<h3 style="color: darkgray;">Đánh giá sản phẩm</h3>
							<div class="component_rating_content" style="display: flex;align-items: center; border: 1px solid #dedede;border-radius: 5px;">
									<div class="rating_item" style="width: 20%; position: relative">
										<span class="fa fa-star" style="font-size: 100px;display: block;color: #ff9705;margin: 0 auto;text-align: center"></span><b style="position: absolute; top: 50%;left: 50%;transform: translateX(-50%) translateY(-50%); color: white;font-size: 20px;">{{ $ageDetail }}</b>
									</div>
									{{--{{ dd($productDetail) }}--}}
									<div class="list_rating" style="width: 60%; padding: 20px;">
										@foreach($arrayRatings as $key =>  $arrayRating){{--key tương ứng = 1,2,3,4,5 sao--}}
											<?php
												$itemAge = round(($arrayRating['total'] / $productDetail->pro_total_rating) * 100,0);
											?>
											<div class="item_rating" style="display: flex; align-items: center">
													<div style="width: 10%; font-size: 14px;">
														{{ $key }} <span class="fa fa-star"></span>
													</div>
													<div style="width: 70%; margin: 0 20px;">
														<span style="width: 100%;height: 8px;display: block;border: 1px solid #dedede; border-radius: 5px;background-color: #dedede;">
															<b style="width: {{ $itemAge }}%; background-color: #f25800;display: block;border-radius: 5px; height: 100%; "></b>
														</span>
													</div>
													<div style="width: 20%">
														<a href="">{{ $arrayRating['total']  }} đánh giá ({{ $itemAge }}%)</a>
													</div>
											</div>
										@endforeach
									</div>
								<div style="width: 20%">
									<a href="#" class="js_rating_action" style="width: 200px;background: #288ad6;padding: 10px; color: white;border-radius: 5px;">Gửi đánh giá của bạn</a>
								</div>
							</div>
							<?php
								$listRatingText = [
								  1 => 'Không thích',
								  2 => 'Tạm được',
								  3 => 'Bình thường',
								  4 => 'Rất tốt',
								  5 => 'Tuyệt vời quá'
								];
							?>
							<div class="form_rating hide">
								<div style="display: flex;margin-top: 15px; font-size: 15px;">
									<p style="margin-bottom: 0">Chọn đánh giá của bạn:</p>
									<span style="margin: 0 15px;" class="list_start">
									@for($i = 1; $i <= 5; $i++)
											<i class="fa fa-star" data-key="{{ $i }}"></i>
										@endfor
								</span>
									<span class="list_text"></span>
									<input type="hidden" value="" class="number_rating">
								</div>
								<div style="margin-top: 15px;">
									<textarea name="" class="form-control" id="ra_content" cols="30" rows="3"></textarea>
								</div>
								<div style="margin-top: 15px;">
									<a href="{{ route('post.rating.product',$productDetail->id) }}" class="js_rating_product" style="width: 200px;background: #288ad6;padding: 5px 10px;color: white;border-radius: 5px;">Gửi đánh giá</a>
								</div>
							</div>
						</div>
					</div>
					<div class="component_list_rating" style="margin-bottom: 30px;">
							@if(isset($ratings))
								@foreach($ratings as $rating)
								<div class="rating_item" style="margin: 10px 0;">
									<div>
										<span style="color: #333;font-weight: bold;text-transform: capitalize"> {{ isset($rating->user->name) ? $rating->user->name : '[N\A]' }} </span>
										<a href="" style="color: #2ba832"><i class="fa fa-check-circle-o"></i> Đã mua hàng tại website </a>
									</div>
									<p style="margin-bottom: 0;">
										<span class="pro-rating">
											@for($i = 1; $i <= 5 ; $i++)
												<i class="fa fa-star {{ $i<=$rating->ra_number ? 'active' : '' }}"></i>
											@endfor
										</span>
										<span>{{ $rating->ra_content }}</span>
									</p>
									<div>
										<span><i class="fa fa-clock-o"> {{$rating->created_at}}</i></span>
									</div>
								</div>
								@endforeach
							@endif
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection

@section('script')
	<script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
		$(function(){
		    let listStart = $(".list_start .fa");
            listRatingText = {
                1 : 'Không thích',
                2 : 'Tạm được',
                3 : 'Bình thường',
                4 : 'Rất tốt',
                5 : 'Tuyệt vời quá',
            };
			listStart.mouseover( function () {
			    let $this = $(this);
			    let number = $this.attr('data-key');
                listStart.removeClass('rating_active');//rơ đánh giá sao

				$(".number_rating").val(number);
			    $.each(listStart , function (key,value) {//foreach
					if(key + 1 <= number)//vì key đì từ 0,=> listRatingText 1 -> 5
					{
						$(this).addClass('rating_active');//hover khi click vào
					}
                });

			    $(".list_text").text('').text(listRatingText[number]).show();//show ra
            });
			$(".js_rating_action").click( function (event) {
				event.preventDefault();
				if($(".form_rating").hasClass('hide'))//nếu nó đang hidden
				{
                    $(".form_rating").addClass('active').removeClass('hide');//mặc định ẩn
				}else
				{
                    $(".form_rating").addClass('hide').removeClass('active');//hien
				}
            });//bat su kien

			$(".js_rating_product").click(function (event) {
				event.preventDefault();
				let content = $("#ra_content").val();//lay du lieu
				let number = $(".number_rating").val();
				let url = $(this).attr('href');

				if(content && number)//neu ton tai xu li ajax
				{
                    $.ajax({
                        url: url,
						type: 'POST',
                        data: {
                            number : number,
                            r_content:content
						}
                    }).done(function(result) {
                      if(result.code == 1)
					  {
					      alert('Đánh giá của bạn sẽ được hệ thống kiểm duyệt. Xin cám ơn.');
					      location.reload();
					  }
                    });
				}
            });

			//san pham vua xem
			//luu id san pham vao storage
			let idProduct = $("#content_product").attr('data-id');

			//lay gia tri storage
			let products = localStorage.getItem('products');

			if (products == null)
			{
			    arrayProduct = new Array();
                arrayProduct.push(idProduct);

                localStorage.setItem('products',JSON.stringify(arrayProduct))
			}else
			{
			    //chuyen ve mang
				products = $.parseJSON(products)

				if (products.indexOf(idProduct) == -1)
				{
				    products.push(idProduct);
                    localStorage.setItem('products',JSON.stringify(products))
				}
			}
		});
	</script>
@stop