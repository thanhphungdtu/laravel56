@extends('admin::layouts.master')
@section('content')
		 <div class="page-header">
		 	<ol class="breadcrumb">
		 		<li><a href="">Trang chủ</a></li>
		 		<li><a href="">Mã giảm giá</a></li>
		 		<li class="active">Danh sách</li>
		 	</ol>
		 </div>
		 <div class="table-responsive">
	   		<h2>Quản lý <a onclick="event.preventDefault();addTaskForm();" href="#" class="pull-right" data-toggle="modal"><i class="fas fa-plus-circle">Thêm mới</i></a></h2>
	        <table class="table table-striped" id="message">
	            <thead>
	                <tr>
	                    <th>#</th>
	                    <th style="width: 250px">Tên mã giảm giá</th>
	                    <th>Số lượng còn lại</th>
	                    <th>Giá trị</th>
						<th>Thao tác</th>
	                </tr>
	            </thead>
	            <tbody>
					@if( isset($discounts))
						@foreach($discounts as $discount)
							<tr>
								<td>
									{{ $discount->id }}
								</td>

								<td>
									{{ $discount->d_name }}
								</td>

								<td>
									{{ $discount->d_qty }}
								</td>

								<td>
									{{ $discount->d_val }}%
								</td>

								<td>
									<a onclick="event.preventDefault();editTaskForm({{$discount->id}});" href="#" class="edit open-modal" data-toggle="modal" value="{{$discount->id}}"><i class="fas fa-pen">Sửa</i></a>
								</td>
							</tr>
						@endforeach
					@endif
	            </tbody>
	        </table>
	    </div>
		 {{--add giam gia--}}
		 <div class="modal fade" id="addTaskModal">
			 <div class="modal-dialog">
				 <div class="modal-content">
					 <form id="frmAddTask">
						 <div class="modal-header">
							 <h4 class="modal-title">
								 Thêm mới mã giảm giá
							 </h4>
							 <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
								 ×
							 </button>
						 </div>
						 <div class="modal-body">
							 <div class="alert alert-danger" id="add-error-bag">
								 <ul id="add-task-errors">
									 {{--error--}}
								 </ul>
							 </div>
							 <div class="form-group">
								 <label>
									 Mã giảm giá
								 </label>
								 <input class="form-control" id="d_name" name="d_name" required="" type="text">
								 </input>
							 </div>
							 <div class="form-group">
								 <label>
									 Số lượng còn lại
								 </label>
								 <input class="form-control" id="d_qty" name="d_qty" required="" type="number">
								 </input>
							 </div>
							 <div class="form-group">
								 <label>
									 Giá trị
								 </label>
								 <input class="form-control" id="d_val" name="d_val" required="" type="number">
								 </input>
							 </div>
						 </div>
						 <div class="modal-footer">
							 <input class="btn btn-default" data-dismiss="modal" type="button" value="Cancel">
							 <button class="btn btn-info" id="btn-add" type="button" value="add">
								 Lưu thông tin
							 </button>
							 </input>
						 </div>
					 </form>
				 </div>
			 </div>
		 </div>
        {{--edit giam gia--}}
         <div class="modal fade" id="editTaskModal">
             <div class="modal-dialog">
                 <div class="modal-content">
                     <form id="frmEditTask">
                         <div class="modal-header">
                             <h4 class="modal-title">
                                 Sữa mã giảm giá
                             </h4>
                             <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                                 ×
                             </button>
                         </div>
                         <div class="modal-body">
                             <div class="alert alert-danger" id="add-error-bag">
                                 <ul id="add-task-errors">
                                     {{--error--}}
                                 </ul>
                             </div>
                             <div class="form-group">
                                 <label>
                                     Mã giảm giá
                                 </label>
                                 <input class="form-control" id="d_name" name="d_name" required="" type="text">
                                 </input>
                             </div>
                             <div class="form-group">
                                 <label>
                                     Số lượng còn lại
                                 </label>
                                 <input class="form-control" id="d_qty" name="d_qty" required="" type="number">
                                 </input>
                             </div>
                             <div class="form-group">
                                 <label>
                                     Giá trị
                                 </label>
                                 <input class="form-control" id="d_val" name="d_val" required="" type="number">
                                 </input>
                             </div>
                         </div>
                         <div class="modal-footer">
                             <input id="discount_id" name="discount_id" type="hidden" value="0">
                             <input class="btn btn-default" data-dismiss="modal" type="button" value="Cancel">
                             <button class="btn btn-info" id="btn-edit" type="button" value="add">
                                 Update Task
                             </button>
                             </input>
                             </input>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
@stop
@section('script')
	<script>
        function addTaskForm() {
            $(document).ready(function() {
                $("#add-error-bag").hide();
                $('#addTaskModal').modal('show');
            });
        }
        let addDiscount = '{{ route('admin.post.create.discount') }}';
        $(document).ready(function() {
            $("#btn-add").click(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: addDiscount,
                    data: {
                        d_name: $("#frmAddTask input[name=d_name]").val(),
                        d_qty: $("#frmAddTask input[name=d_qty]").val(),
                        d_val: $("#frmAddTask input[name=d_val]").val(),
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#frmAddTask').trigger("reset");
                        $("#frmAddTask .close").click();
                        window.location.reload(alert('Thêm mới mã giảm giá thành công!'));
                    },
                    error: function(data) {
                        var errors = $.parseJSON(data.responseText);
                        $('#add-task-errors').html('');
                        $.each(errors.messages, function(key, value) {
                            $('#add-task-errors').append('<li>' + value + '</li>');
                        });
                        $("#add-error-bag").show();
                    }
                });
            });
        });
        //edit
        function editTaskForm(task_id) {
            $.ajax({
                type: 'GET',
                url: '/admin/discount/update/' + task_id,
                success: function (data) {
                    $("#edit-error-bag").hide();
                    $("#frmEditTask input[name=d_name]").val(data.task.d_name);
                    $("#frmEditTask input[name=d_qty]").val(data.task.d_qty);
                    $("#frmEditTask input[name=d_val]").val(data.task.d_val);
                    $("#frmEditTask input[name=discount_id]").val(data.task.id);
                    $('#editTaskModal').modal('show');
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }
        //update
        $("#btn-edit").click(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/admin/discount/update/' + $("#frmEditTask input[name=discount_id]").val(),
                data: {
                    d_name: $("#frmEditTask input[name=d_name]").val(),
                    d_qty: $("#frmEditTask input[name=d_qty]").val(),
                    d_val: $("#frmEditTask input[name=d_val]").val(),
                },
                dataType: 'json',
                success: function(data) {
                    $('#frmEditTask').trigger("reset");
                    $("#frmEditTask .close").click();
                    window.location.reload(alert('Cập nhật mã giảm giá thành công!'));
                },
                error: function(data) {
                    var errors = $.parseJSON(data.responseText);
                    $('#edit-task-errors').html('');
                    $.each(errors.messages, function(key, value) {
                        $('#edit-task-errors').append('<li>' + value + '</li>');
                    });
                    $("#edit-error-bag").show();
                }
            });
        });
	</script>
@stop
