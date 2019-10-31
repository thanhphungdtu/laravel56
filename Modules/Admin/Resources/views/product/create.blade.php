@extends('admin::layouts.master')
@section('content')
		 <div class="page-header">
		 	<ol class="breadcrumb">
		 		<li><a href="">Trang chủ</a></li>
		 		<li><a href="{{ route('admin.get.list.product') }}">Sản phẩm</a></li>
		 		<li class="active">Thêm mới</li>
		 	</ol>
		 </div>
	   		<div class="">
	   			@include('admin::product.form')
	   		</div>
@stop