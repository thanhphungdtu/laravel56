@extends('layouts.app')
@section('content')
    <?php
    $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $vnp_Returnurl = "http://website.com/shopping/complete";
    $vnp_TmnCode = "JM6DL7CV";//Mã website tại VNPAY
    $vnp_HashSecret = "WKKEYLCIHJSVQPVMNKHVSVLGNRDRWNIK"; //Chuỗi bí mật

    ?>
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
                                <a href="/">Giỏ hàng</a>
                                <span><i class="fa fa-angle-right"></i></span>
                            </li>

                            <li class="category3"><span>Thanh toán </span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-contact-area">
        <div class="container">
            <div id="content">

                <form action="" method="post" class="beta-form-checkout">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 class="hihi">Thông tin thanh toán</h4>
                            <div class="space20">&nbsp;</div>

                            <div class="form-block">
                                <label for="name">Họ tên*</label>
                                <input type="text" id="name" placeholder="Họ tên" name="username" required="" value="{{ get_data_user('web','name') }}">
                            </div>

                            <div class="form-block">
                                <label for="email">Email*</label>
                                <input type="email" id="email" required="" name="email" placeholder="expample@gmail.com"  value="{{ get_data_user('web','email') }}">
                            </div>

                            <div class="form-block">
                                <label for="adress">Địa chỉ*</label>
                                <input type="text" id="adress" placeholder="Street Address" required="" name="adress" value="{{ get_data_user('web','address') }}">
                            </div>


                            <div class="form-block">
                                <label for="phone">Điện thoại*</label>
                                <input type="text" id="phone" required="" name="phone" value="{{ get_data_user('web','phone') }}">
                            </div>

                            <div class="form-block">
                                <label for="notes">Ghi chú</label>
                                <textarea id="notes" name="note"></textarea>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="your-order">
                                <div class="your-order-head"><h5>Đơn hàng của bạn<a href="{{ route('get.list.shopping.cart') }}" class="pull-right" style="font-size: 14px; font-weight: bold">Cập nhật</a></h5></div>
                                @foreach($products as $product)
                                <div class="your-order-body" style="padding: 0px 10px">
                                    <div class="your-order-item">
                                        <div>
                                            <!--  one item	 -->
                                            <div class="media">
                                                <img width="20%" src="{{ pare_url_file($product->options->avatar) }}" alt="" class="pull-left">
                                                <div class="media-body">
                                                    <p class="font-large">{{ $product->name }}</p>
                                                    <span class="color-gray your-order-info">Số lượng x: {{ $product->qty }}</span>
                                                </div>
                                            </div>
                                            <!-- end one item -->
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="your-order-item">
                                        <div class="pull-left"><p class="your-order-f18">Thành tiền:</p></div>
                                        <div class="pull-right"><h5 class="color-black">{{ number_format($product->price *  $product->qty,0,',','.') }} đ</h5></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="your-order-item">
                                    <div class="pull-left"><p class="your-order-f18" style="color: #2b66c9;font-weight: bold;">TỔNG TIỀN THANH TOÁN:</p></div>
                                    <?php
                                    $total_pay = str_replace(',','',Cart::subtotal(0,3));
                                    $total =  str_replace(',','',Cart::subtotal(0,3)) / 22300 ;
                                    $total_usd = ceil($total);
                                    ?>
                                    <div class="pull-right" style="margin-right: 10px;"><h5 class="color-black">{{ str_replace(',','.',Cart::subtotal(0,3)) }} VND</h5></div>
                                    <div class="clearfix"></div>
                                    <div class="controls">
                                        <label for="payment_method_bacs">Mã giảm giá :</label>
                                        <input type="text" name="d_name" id="coupon">
                                        <a href="javascript:;" name="btncoupon" id="btncoupon" class="" style="border: 1px solid wheat; border-radius: 5px; padding: 10px; background: cornsilk;color: black  ">Áp dụng</a>
                                    </div>
                                </div>
                                <div class="your-order-head"><h5>Hình thức thanh toán</h5></div>

                                <div class="your-order-body">
                                    <ul class="payment_methods methods">
                                        <li class="payment_method_bacs">
                                            <input id="payment_method_bacs" type="radio" class="input-radio" required name="payment_method" value="COD" data-order_button_text="">
                                            <label for="payment_method_bacs">Thanh toán khi nhận hàng </label>
                                            <div class="payment_box payment_method_bacs" style="display: block;">
                                                Cửa hàng sẽ gửi hàng đến địa chỉ của bạn, bạn xem hàng rồi thanh toán tiền cho nhân viên giao hàng
                                            </div>
                                        </li>

                                        <li class="payment_method_cheque">
                                            <div id="paypal-button-container">
                                                <input id="forwardStep" type="radio" required name="payment_method" value="Paypal"> Thanh toán với Paypal
                                                <div id="paypal-button-container"></div>
                                            </div>
                                        </li>
                                        <?php
                                        //đẩy lên url
                                        $vnp_TxnRef = date('YmdHis');//Mã đơn hàng.
                                        $vnp_OrderInfo = 'Tôi muốn giao hang nhanh';
                                        $vnp_OrderType = $product->qty;
                                        $vnp_Amount = $total_pay * 100;
                                        $vnp_Locale = 'VN';
                                        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
                                        $inputData = array(
                                            "vnp_Version" => "2.0.0",
                                            "vnp_TmnCode" => $vnp_TmnCode,
                                            "vnp_Amount" => $vnp_Amount,
                                            "vnp_Command" => "pay",
                                            "vnp_CreateDate" => date('YmdHis'),
                                            "vnp_CurrCode" => "VND",
                                            "vnp_IpAddr" => $vnp_IpAddr,
                                            "vnp_Locale" => $vnp_Locale,
                                            "vnp_OrderInfo" => $vnp_OrderInfo,
                                            "vnp_OrderType" => $vnp_OrderType,
                                            "vnp_ReturnUrl" => $vnp_Returnurl,
                                            "vnp_TxnRef" => $vnp_TxnRef,
                                        );
                                        ksort($inputData);
                                        $query = "";
                                        $i = 0;
                                        $hashdata = "";
                                        foreach ($inputData as $key => $value) {
                                            if ($i == 1) {
                                                $hashdata .= '&' . $key . "=" . $value;
                                            } else {
                                                $hashdata .= $key . "=" . $value;
                                                $i = 1;
                                            }
                                            $query .= urlencode($key) . "=" . urlencode($value) . '&';
                                        }

                                        $vnp_Url = $vnp_Url . "?" . $query;
                                        if (isset($vnp_HashSecret)) {
                                            $vnpSecureHash = hash('sha256',$vnp_HashSecret . $hashdata);
                                            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
                                        }
                                        ?>

                                    </ul>
                                </div>

                                <div class="text-center">
                                    <button class="beta-btn primary" type="submit">Xác nhận <i class="fa fa-chevron-right"></i></button>
                                    <a style="padding: 9px;" href="<?php echo $vnp_Url ?>" class="beta-btn primary" type="submit">Thanh toán bằng thẻ <i style="font-size: 12px;"  class="glyphicon glyphicon-credit-card"></i></a>
                                </div>
                            </div> <!-- .your-order -->
                        </div>
                    </div>
                </form>
            </div> <!-- #content -->
        </div>
    </div>


    <!-- Include the PayPal JavaScript SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id=sb&currency=USD"></script>

    <script>
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({

            // Set up the transaction
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?php echo $total_usd ?>',
                        }
                    }]
                });
            },

            // Finalize the transaction
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Show a success message to the buyer
                    alert('Đã thanh toán bằng paypal. Vui lòng click vào nút đặt hàng để nhân viên xác nhận ' + details.payer.name.given_name + '!');
                });
            }


        }).render('#paypal-button-container');
    </script>
@endsection
