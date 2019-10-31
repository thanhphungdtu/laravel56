@extends('admin::layouts.master')
@section('content')
		 <div class="page-header">
		 	<ol class="breadcrumb">
		 		<li><a href="{{ route('admin.home') }}">Trang chủ</a></li>
		 		<li><a href="{{ route('admin.get.list.admin') }}">Ban quản trị</a></li>
		 		<li class="active">Thêm mới</li>
		 	</ol>
		 </div>
	   		<div class="">
				<div class="col-sm-8">
					<form action="" method="post" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<label for="a_name">Họ tên:</label>
							<input type="text" class="form-control"  placeholder="Họ tên" value="{{ old('name') }}" name="name">
						</div>

						<div class="form-group">
							<label for="a_description">Email:</label>
							<input type="email" class="form-control"  placeholder="Nhập email" value="{{ old('email') }}" name="email">
						</div>

						<div class="form-group">
							<label for="a_description">Username:</label>
							<input type="text" class="form-control"  placeholder="Nhập username" value="{{ old('username') }}" name="username">
						</div>

						<div class="form-group">
							<label for="a_description">Mật khẩu:</label>
							<input type="password" class="form-control" name="password">
						</div>

						<div class="form-group">
							<label for="a_description">Số điện thoại:</label>
							<input type="number" class="form-control"   value="{{ old('phone') }}" name="phone">
						</div>

						<div class="form-group">
							<label>User Level</label>
							<label class="radio-inline">
								<input name="rdoLevel" value="1"  type="radio">Admin
							</label>
							<label class="radio-inline">
								<input name="rdoLevel" value="2" checked="" type="radio">User
							</label>
						</div>


						<button type="submit" class="btn btn-success">Lưu thông tin</button>
					</form>
				</div>
	   		</div>
@stop