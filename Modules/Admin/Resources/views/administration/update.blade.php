@extends('admin::layouts.master')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.home') }}">Trang chủ</a></li>
            <li><a href="{{ route('admin.get.list.article') }}">Ban quản trị</a></li>
            <li class="active">Cập nhật</li>
        </ol>
    </div>
    <div class="">
        <div class="col-sm-8">
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="a_name">Họ tên:</label>
                    <input type="text" class="form-control"  placeholder="Họ tên" value="{{ old('name',$admins->name ) }}" name="name">
                </div>

                <div class="form-group">
                    <label for="a_description">Email:</label>
                    <input type="email" class="form-control"  disabled  placeholder="Nhập email" value="{{ old('email',$admins->email ) }}" name="email">
                </div>

                <div class="form-group">
                    <label for="a_description">Username:</label>
                    <input type="text" class="form-control"  placeholder="Nhập username" value="{{ old('username',$admins->username) }}" name="username">
                </div>

                <div class="form-group">
                    <label for="a_description">Mật khẩu:</label>
                    <input type="password" class="form-control" name="password">
                    <p style="color: red; font-weight: bold;font-style: italic">Nếu thay đổi mật khẩu mới nhập giá trị</p>
                </div>

                <div class="form-group">
                    <label for="a_description">Số điện thoại:</label>
                    <input type="number" class="form-control"   value="{{ old('phone',$admins->phone) }}" name="phone">
                </div>

                @if(get_data_user('admins','id') != $admins->id )
                    <div class="form-group">
                        <label>User Level</label>
                        <label class="radio-inline">
                            <input name="rdoLevel" value="1" type="radio"
                                   @if($admins->role == 1)
                                   checked="checked"
                                    @endif
                            >Admin
                        </label>
                        <label class="radio-inline">
                            <input name="rdoLevel" value="2" type="radio"
                                   @if($admins->role == 2)
                                   checked="checked"
                                    @endif
                            >User
                        </label>
                    </div>
                @endif


                <button type="submit" class="btn btn-success">Lưu thông tin</button>
            </form>
        </div>
    </div>
@stop