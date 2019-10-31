@extends('layouts.app')
@section('content')
    <div class="main-contact-area">
        <div class="container" style="margin-right: 30px;">
            <font face="Arial">
        <div>
            <h3><font color="#FF9600">Quý khách đã đặt hàng thành công!</font>
                <a href="{{ route('home') }}" class="pull-right alert-info" style="padding: 8px;border-radius: 10px;">
                    <i class="glyphicon glyphicon-arrow-left"></i>Quay lại mua sắm
                </a>
            </h3>
            <p>- Hóa đơn mua hàng của Quý khách đã được chuyển đến địa chỉ
                Email có trong phần thông tin khách hàng của chúng tôi.</p>
            <p>- Sản phẩm của Quý khách sẽ được chuyển đến địa chỉ có trong
                phần thông tin khách hàng của chúng tôi sau thời 2 đến đến 3
                ngày tính từ thời điểm này</p>
            <p>- Nhân viên giao hàng sẽ liên hệ với Quý khách qua số điện
                thoại trước khi giao hàng 24 tiếng.</p>
            <p>- Trụ sở chính: B&A Phạm Như Xương - Liên Chiểu - Đà Nẵng</p>
            <p>Cảm ơn Quý khách đã sử dụng công ty chúng tôi.</p>
        </div>
    </font>
        </div>
    </div>
@endsection