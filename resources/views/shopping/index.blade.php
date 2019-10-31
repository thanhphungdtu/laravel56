@extends('layouts.app')
@section('content')
<script type="text/javascript">
    function updateCart(qty,rowId){
        $.get(
            '{{ route('update.shopping.cart') }}',
            { qty:qty,rowId:rowId },
            function () {
                location.reload(alert('Giỏ hàng đã được cập nhật'));
            }
        );
    }
</script>
    <div class="our-product-area new-product">
        <div class="container">
            <div class="area-title">
                <h2>Giỏ hàng của bạn</h2>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1 ?>
                @foreach($products as $key => $product)
                    {{--{{  dd($product) }}--}}
                    <tr>
                        <td>#{{ $i++ }}</td>
                        <td><a href="">{{ $product->name }}</a></td>
                        <td>
                            <img src="{{ pare_url_file($product->options->avatar) }}" alt="" width="50px">
                        </td>
                        <td>{{ number_format($product->price,0,',','.') }}đ</td>
                        <td style="width: 80px; height: 0px;">
                           <div class="form-group">
                               <input type="number" class="form-control" value="{{ $product->qty }}" onchange="updateCart(this.value,'{{ $product->rowId  }}')">
                           </div>
                        </td>
                        <td>{{ number_format($product->price * $product->qty,0,',','.') }}đ</td>
                        <td>
                            <a href="{{ Route('delete.shopping.cart',$key) }}" ><i class="fa fa-trash-o"> Xóa</i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <h4 class="pull-right">Tổng số tiền cần thanh toán {{ str_replace(',','.',Cart::subtotal(0,3)) }} đ   <a href="{{ route('get.form.pay') }}" class="btn-success btn">Thanh toán</a></h4>
        </div>
    </div>
@endsection