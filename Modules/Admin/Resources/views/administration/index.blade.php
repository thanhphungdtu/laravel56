@extends('admin::layouts.master')
@section('content')
		 <div class="page-header">
		 	<ol class="breadcrumb">
		 		<li><a href="">Trang chủ</a></li>
		 		<li><a href="{{ route('admin.get.list.admin') }}">Ban quản trị</a></li>
		 		<li class="active">Danh sách</li>
		 	</ol>
		 </div>

		 <div class="table-responsive">
	   		<h2>Quản lý ban quản trị<a href="{{ route('admin.get.create.admin') }}" class="pull-right"><i class="fas fa-plus-circle">Thêm mới</i></a></h2>
	        <table class="table table-striped" id="message">
	            <thead>
	                <tr>
	                    <th>#</th>
	                    <th>Họ tên</th>
	                    <th>Email</th>
						<th>Quyền</th>
	                    <th>Thao tác</th>
	                </tr>
	            </thead>
	            <tbody>
					@if( isset($admins))
						@foreach($admins as $admin)
							<tr>
								<td>
									{{ $admin->id }}
								</td>

								<td>
									{{ $admin->name }}
								</td>

								<td>
									{{ $admin->email }}
								</td>

								<td>
                                    <?php
										if($admin->role == 1 && $admin->username == 'admin' && $admin->id == 1){
											echo 'SupperAdmin';
										}else if($admin->role == 1 && $admin->username == 'admindemo'){
											echo 'Admin demo';
										}else if($admin->role == 2){
											echo 'User';
										}else if($admin->role == 1){
                                            echo 'Admin';
										}
                                    ?>
								</td>

								<td>
									{{--@can('admin')--}}
									<a href="{{ route('admin.get.edit.admin',$admin->id) }}"><i class="fas fa-pen"></i></a>
									<a onclick="return xacnhanxoa('Bạn có chắc muốn xóa không !')" href="{{ route('admin.get.delete.admin',[$admin->id]) }}"><i class="fas fa-trash-alt"></i></a>
									{{--@endcan--}}
								</td>
							</tr>
						@endforeach
					@endif
	            </tbody>
	        </table>
	    </div>
@stop