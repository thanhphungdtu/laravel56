@extends('admin::layouts.master')
@section('content')
		 <div class="page-header">
		 	<ol class="breadcrumb">
		 		<li><a href="">Trang chủ</a></li>
		 		<li><a href="">Danh mục</a></li>
		 		<li class="active">Danh sách</li>
		 	</ol>
		 </div>
	   <div class="table-responsive">
	   		<h2>Quản lý danh mục <a href="{{ route('admin.get.create.category') }}" class="pull-right"><i class="fas fa-plus-circle">Thêm mới</i></a></h2>
	        <table class="table table-striped" id="message">
	            <thead>
	                <tr>
	                    <th>#</th>
	                    <th>Tên danh mục</th>
						<th>Danh mục cha</th>
	                    <th>Title Seo</th>
						<th>Trang chủ</th>
	                    <th>Trạng Thái</th>
	                    <th>Thao tác</th>
	                </tr>
	            </thead>
	            <tbody>
					@if( isset($categories))
						@foreach($categories as $category)
							<tr>
								<td>{{ $category->id }}</td>
								<td>{{ $category->c_name }}</td>
								<td>
									@if($category->parent_id == 0)
										{!! 'None' !!}
									@else
                                        <?php
                                        $parent = DB::table('categories')->where('id',$category->parent_id)->first();
                                        echo $parent->c_name;
                                        ?>
									@endif
								</td>
								<td>{{ $category->c_title_seo }}</td>
								<td>
									<a href="{{ route('admin.get.action.category',['home',$category->id]) }}" class="label {{ $category->getHome($category->c_home)['class'] }}">{{ $category->getHome($category->c_home)['name'] }}</a>
								</td>
								<td>
									<a href="{{ route('admin.get.action.category',['active',$category->id]) }}" class="label {{ $category->getStatus($category->c_active)['class'] }}">{{ $category->getStatus($category->c_active)['name'] }}</a>
								</td>
								<td>
									<a href="{{ route('admin.get.edit.category',$category->id) }}"><i class="fas fa-pen"></i></a>
									<a onclick="return xacnhanxoa('Bạn có chắc muốn xóa không !')" href="{{ route('admin.get.action.category',['delete',$category->id]) }}"><i class="fas fa-trash-alt"></i></a>
								</td>
							</tr>
						@endforeach
					@endif
	            </tbody>
	        </table>
	    </div>
@stop