@extends('user.layout')
@section('content')
    <h1 class="page-header">Tổng quan</h1>
    <div class="row placeholders">
        <div class="col-xs-6 col-sm-4 placeholder" style="position: relative">
            <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
            <h4 style="position: absolute;top: 50%;left: 50%;transform: translateX(-50%) translateY(-50%);margin: 0; color: #0c1923">{{ $totalTransaction }} Tổng số đơn hàng</h4>
        </div>
        <div class="col-xs-6 col-sm-4 placeholder" style="position: relative">
            <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
            <h4 style="position: absolute;top: 50%;left: 50%;transform: translateX(-50%) translateY(-50%);margin: 0; color: #0c1923">{{ $totalTransactionDone }} Đã xử lý</h4>
        </div>
        <div class="col-xs-6 col-sm-4 placeholder" style="position: relative">
            <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
            <h4 style="position: absolute;top: 50%;left: 50%;transform: translateX(-50%) translateY(-50%);margin: 0; color: #0c1923">{{ $totalTransactionDefault }} Chưa xử lý</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h2 style="margin: 0px;">Danh sách đơn hàng của bạn</h2>
            <table class="table table-striped" id="dataTables-example">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Tên khách hàng</th>
                    <th>Địa chỉ</th>
                    <th>Phone</th>
                    <th>Tổng tiền</th>
                    <th>Trạng Thái</th>
                    <th style="width: 90px;">Thời gian</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        $stt = 1;
                    ?>
                    @if(isset($transactions))
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>#{{ $stt++ }}</td>
                                <td>{{ isset($transaction->user->name) ? $transaction->user->name : '[N\A]'}}</td>
                                <td>{{ $transaction->tr_address }}</td>
                                <td>{{ $transaction->tr_phone }}</td>
                                <td>{{ number_format($transaction->tr_total,0,',','.') }} VNĐ</td>
                                <td>
                                    @if ($transaction->tr_status == 1)
                                        <a href="#" class="label-success label">Đã xử lý</a>
                                    @else
                                        <a href="#" class="label label-danger">Chờ xử lý</a>
                                    @endif
                                </td>
                                <td>
                                    {{ $transaction->created_at->format('d-m-Y') }}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop