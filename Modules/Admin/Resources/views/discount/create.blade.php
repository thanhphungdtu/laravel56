@extends('admin::layouts.master')
@section('content')
		 <div class="page-header">
		 	<ol class="breadcrumb">
		 		<li><a href="{{ route('admin.home') }}">Trang chủ</a></li>
		 		<li><a href="{{ route('admin.get.list.discount') }}">Danh sách</a></li>
		 		<li class="active">Thêm mới</li>
		 	</ol>
		 </div>
	   		<div class="">
				<div class="col-sm-8">
					<form action="" method="post" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<label for="ps_name">Mã giảm giá:</label>
							<input type="text" class="form-control" required placeholder="Mã giảm giá" value="{{ old('d_name') }}" name="d_name">
						</div>

						<div class="form-group">
							<label for="ps_name">Số lượng còn lại:</label>
							<input type="number" class="form-control" required  value="{{ old('d_qty') }}" name="d_qty">
						</div>

						<div class="form-group">
							<label for="ps_name">Giá trị:</label>
							<input type="number" class="form-control" required  value="{{ old('d_val') }}" name="d_val">
						</div>

						<button type="submit" class="btn btn-success">Lưu thông tin</button>
					</form>
				</div>
				@section('script')
					<script src="{{ asset('/public/theme_admin/ckeditor/ckeditor.js') }}"></script>
					<script>
                        CKEDITOR.replace('pro_content');
					</script>
				@stop
	   		</div>
@stop