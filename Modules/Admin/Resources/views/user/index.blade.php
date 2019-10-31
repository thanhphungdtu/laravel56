@extends('admin::layouts.master')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li><a href="">Trang chủ</a></li>
            <li><a href="">Thành viên</a></li>
            <li class="active">Danh sách</li>
        </ol>
    </div>
    <div class="table-responsive">
        <h2>Quản lý thành viên</h2>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Tên thành viên</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Avatar</th>
                <th>Thao tác</th>
            </tr>
            </thead>
            <tbody>
                @if($users)
                    @foreach($users as $user)
                        <tr>
                            <td>
                                {{ $user->id }}
                            </td>
                            <td>
                                {{ $user->name }}
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                {{ $user->phone }}
                            </td>
                            <td>
                                <img src="{{ pare_url_file($user->avatar) }}" alt="" style="width: 80px;" class="img img-responsive">
                            </td>
                            <td>
                                <a href="{{ route('admin.get.delete.user',[$user->id]) }}"><i class="fas fa-trash-alt"></i> Xóa</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@stop
