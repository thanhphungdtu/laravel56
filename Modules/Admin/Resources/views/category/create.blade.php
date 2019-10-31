@extends('admin::layouts.master')
@section('content')
		 <div class="page-header">
		 	<ol class="breadcrumb">
		 		<li><a href="">Trang chủ</a></li>
		 		<li><a href="{{ route('admin.get.list.category') }}">Danh mục</a></li>
		 		<li class="active">Thêm mới</li>
		 	</ol>
		 </div>
	   		<div class="">
	   				<form action="" method="post">
	   					 @csrf
						<div class="form-group">
							<label for="email">Tên danh mục cha:</label>
							<select class="form-control" name="sltParent">
								<option value="">--Chọn loại danh mục cha--</option>
                                <?php cate_parent($parent,0,"--",old('sltParent')) ?>
							</select>
						</div>

		   				 <div class="form-group">
					      <label for="email">Tên danh mục:</label>
					      <input type="text" class="form-control"  placeholder="Tên danh mục" value="{{ old('name') }}" name="name">
					      @if($errors->has('name'))
					        <div class="error-text">
					            {{$errors->first('name')}}
					        </div>
					      @endif
					    </div>

					    <div class="form-group">
					      <label for="email">Icon:</label>
					      <input type="text" class="form-control"  placeholder="fa fa-home" value="{{ old('icon') }}" name="icon">
					        @if($errors->has('icon'))
					        <div class="error-text">
					            {{$errors->first('icon')}}
					        </div>
					      @endif
					    </div>

						<div class="form-group">
							<label for="email">Meta Title:</label>
							<input type="text" class="form-control"  placeholder="Meta title" value="{{ old('c_title_seo') }}" name="c_title_seo">
						</div>

						<div class="form-group">
							<label for="email">Meta Description:</label>
							<input type="text" class="form-control"  placeholder="Meta Description" value="{{ old('c_description_seo') }}" name="c_description_seo">
						</div>

					    <div class="form-group">
						   <div class="checkbox">
						    <label><input type="checkbox" name="hot">Nổi bật</label>
						  </div>
						 </div>
					    <button type="submit" class="btn btn-success">Lưu thông tin</button>	
	   				</form>
	   		</div>
@stop