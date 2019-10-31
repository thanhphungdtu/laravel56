@extends('admin::layouts.master')
@section('content')
		 <div class="page-header">
		 	<ol class="breadcrumb">
		 		<li><a href="">Trang chủ</a></li>
		 		<li><a href="">Page Static</a></li>
		 		<li class="active">Danh sách</li>
		 	</ol>
		 </div>
		 <div class="table-responsive">
	   		<h2>Quản lý <a href="{{ route('admin.get.create.page_static') }}" class="pull-right"><i class="fas fa-plus-circle">Thêm mới</i></a></h2>
	        <table class="table table-striped" id="message">
	            <thead>
	                <tr>
	                    <th>#</th>
	                    <th style="width: 250px">Tiêu đề trang</th>
	                    <th>Ngày tạo</th>
	                    <th>Thao tác</th>
	                </tr>
	            </thead>
	            <tbody>
					@if( isset($pageStatics))
						@foreach($pageStatics as $pageStatic)
							<tr>
								<td>
									{{ $pageStatic->id }}
								</td>
								<td>
									{{ $pageStatic->ps_name }}
								</td>
								<td>
									{{ $pageStatic->created_at }}
								<td>
									<a href="{{ route('admin.get.edit.page_static',$pageStatic->id) }}"><i class="fas fa-pen">Edit</i></a>
								</td>
							</tr>
						@endforeach
					@endif
	            </tbody>
	        </table>
	    </div>
@stop