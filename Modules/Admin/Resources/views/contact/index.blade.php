@extends('admin::layouts.master')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li><a href="">Trang chủ</a></li>
            <li><a href="">Liên hệ</a></li>
            <li class="active">Danh sách</li>
        </ol>
    </div>
    <div class="table-responsive">
        <h2>Quản lý liên hệ</h2>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Tiêu đề</th>
                <th style="width: 250px">Họ tên</th>
                <th>Email</th>
                <th>Nội dung</th>
                <th>Trạng thái</th>
                <th style="text-align: center">Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @if($contacts)
                @foreach($contacts as $contact)
                    <tr>
                        <td>
                            {{ $contact->id }}
                        </td>
                        <td>
                            {{ $contact->c_title }}
                        </td>
                        <td>
                            {{ $contact->c_name }}
                        </td>
                        <td>{{ $contact->c_email }}</td>
                        <td>
                            {{ $contact->c_content }}
                        </td>
                        <td>
                            <a href="{{ route('admin.action.contact',['status',$contact->id]) }}" class="label {{$contact->getStatus($contact->c_status)['class']}}">{{ $contact->getStatus($contact->c_status)['name'] }}</a>
                        </td>
                        <td style="text-align: center">
                            <a href=""><i class="fas fa-pen">Cập nhật</i></a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@stop