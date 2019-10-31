@extends('admin::layouts.master')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li><a href="">Trang chủ</a></li>
            <li><a href="">Đơn hàng</a></li>
            <li class="active">Danh sách</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <form class="form-inline" action="">
                <div class="form-group pull-right">
                    <input type="text" class="form-control" placeholder="Tên sản phẩm ..." name="name" value="{{ \Request::get('name') }}">
                </div>

                <button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <h2>Quản lý đơn hàng<a href ="{{ route('admin.transaction.export') }}?name={{ \Request::get('name') }}" class="btn btn-info export pull-right" id="export-button"> Export đơn hàng </a></h2>
        <table class="table table-striped" id="dataTables-example">
            <thead>
            <tr>
                <th>#</th>
                <th>Tên khách hàng</th>
                <th style="width: 200px;">Địa chỉ</th>
                <th>Phone</th>
                <th>Tổng tiền</th>
                <th>Trạng Thái</th>
                <th>Hình thức(TT)</th>
                <th>Thời gian</th>
                <th>Thao tác</th>
            </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td>#{{ $transaction->id }}</td>
                        <td>{{ isset($transaction->user->name) ? $transaction->user->name : '[N\A]'}}</td>
                        <td>{{ $transaction->tr_address }}</td>
                        <td>{{ $transaction->tr_phone }}</td>
                        <td>{{ number_format($transaction->tr_total,0,',','.') }} VNĐ</td>
                        <td>
                            @if ($transaction->tr_status == 1)
                                <a href="#" class="label-success label">Đã xử lý</a>
                            @else
                                <a href="{{ route('admin.get.active.transaction',$transaction->id) }}" class="label label-danger">Chờ xử lý</a>
                            @endif
                        </td>
                        <td style="text-align: center">
                            {{ $transaction->tr_payment }}
                        </td>
                        <td>
                            {{ $transaction->created_at->format('d-m-Y') }}
                        </td>
                        <td>
                            <a onclick="return xacnhanxoa('Bạn có chắc muốn xóa không !')" href="{{ route('admin.get.delete.transaction',$transaction->id) }}"><i class="fas fa-trash-alt"></i> Xóa</a>
                            <a class="js_order_item" data-id="{{ $transaction->id }}" href="{{ route('admin.get.view.order',$transaction->id) }}"><i class="fas fa-eye" style="margin-right: 5px; margin-left: 5px;"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pull-right">
            {{ $transactions->links() }}
        </div>
    </div>

    <div id="myModalOrder" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header ">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Chi tiết mã đơn hàng #<b class="transaction_id"></b></h4>
                </div>
                <div class="modal-body" id="md_content">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
@stop
@section('script')
    <script>
        $(function () {
            $(".js_order_item").click(function (event) {
                event.preventDefault();//bat su kien , ko cho load lai trang
                let $this = $(this);//khai bao con tro this
                let url = $this.attr('href');//lay duong dan url: lay thuoc tinh href
                $(".transaction_id").text('').text($this.attr('data-id'));//lay id ma don hang

                $("#myModalOrder").modal('show');//show sp
               //console.log(url);
                $.ajax({
                    url: url,
                }).done(function (result) {
                    //console.log(result);
                    if(result){
                        $("#md_content").html('').append(result);
                    }
                });
            });
        })
    </script>
@stop