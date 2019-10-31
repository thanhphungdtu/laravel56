@extends('admin::layouts.master')
@section('content')
		 <div class="page-header">
		 	<ol class="breadcrumb">
		 		<li><a href="">Trang chủ</a></li>
		 		<li><a href="">Bài Viết</a></li>
		 		<li class="active">Danh sách</li>
		 	</ol>
		 </div>
		 <div class="row">
			<div class="col-sm-12">
				<form class="form-inline" action="">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Tên bài viết ..." name="name" value="{{ \Request::get('name') }}">
					</div>

					<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
				</form>
			</div>
		 </div>
		 <div class="table-responsive">
	   		<h2>Quản lý bài viết<a href="{{ route('admin.get.create.article') }}" class="pull-right"><i class="fas fa-plus-circle">Thêm mới</i></a></h2>
	        <table class="table table-striped" id="message">
	            <thead>
	                <tr>
	                    <th>#</th>
	                    <th style="width: 250px">Tên bài viết</th>
	                    <th style="width: 200px">Mô tả</th>
						<th>Hình ảnh</th>
						<th>Nổi bật</th>
						<th>Trạng thái</th>
	                    <th>Ngày tạo</th>
	                    <th>Thao tác</th>
	                </tr>
	            </thead>
	            <tbody>
					@if( isset($articles))
						@foreach($articles as $article)
							<tr>
								<td>
									{{ $article->id }}
								</td>
								<td>
									{{ $article->a_name }}
								</td>
								<td>
									{{ $article->a_description }}
								</td>
								<td>
									<img src="{{ pare_url_file($article->a_avatar) }}" alt="" style="width: 80px;" class="img img-responsive">
								</td>
								<td>
									<a href="{{ route('admin.get.action.article',['hot',$article->id]) }}" class="label {{$article->getHot($article->a_hot)['class']}}">{{ $article->getHot($article->a_hot)['name'] }}</a>
								</td>
								<td>
									<a href="{{ route('admin.get.action.article',['active',$article->id]) }}" class="label {{$article->getStatus($article->a_active)['class']}}">{{ $article->getStatus($article->a_active)['name'] }}</a>
								</td>
								<td>
								{{ $article->created_at }}
								<td>
									<a href="{{ route('admin.get.edit.article',$article->id) }}"><i class="fas fa-pen"></i></a>
									<a onclick="return xacnhanxoa('Bạn có chắc muốn xóa không !')" href="{{ route('admin.get.action.article',['delete',$article->id]) }}"><i class="fas fa-trash-alt"></i></a>
								</td>
							</tr>
						@endforeach
					@endif
	            </tbody>
	        </table>
	    </div>
@stop