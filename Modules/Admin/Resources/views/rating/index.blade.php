@extends('admin::layouts.master')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li><a href="">Trang chủ</a></li>
            <li><a href="">Đánh giá</a></li>
            <li class="active">Danh sách</li>
        </ol>
    </div>
    <div class="table-responsive">
        <h2>Quản lý đánh giá</h2>
        <table class="table table-striped" id="message">
            <thead>
            <tr>
                <th>#</th>
                <th>Tên thành viên</th>
                <th style="width: 250px">Tên sản phẩm</th>
                <th>Nội dung</th>
                <th>Rating</th>
                <th style="text-align: center">Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @if($ratings)
                @foreach($ratings as $rating)
                    <tr>
                        <td>
                            {{ $rating->id }}
                        </td>
                        <td>
                            {{ isset($rating->user->name) ? $rating->user->name : '[N\A]' }}
                        </td>
                        <td>
                            <a href="">{{ isset($rating->product->pro_name) ? $rating->product->pro_name : '[N\A]' }}</a>
                        </td>
                        <td>{{ $rating->ra_content }}</td>
                        <td>
                            {{ $rating->ra_number }}
                        </td>
                        <td style="text-align: center">
                            <a onclick="return xacnhanxoa('Bạn có chắc muốn xóa không !')" href="{{ route('admin.get.action.rating',['delete',$rating->id]) }}"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@stop