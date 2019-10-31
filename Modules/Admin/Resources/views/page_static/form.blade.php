<div class="col-sm-8">
<form action="" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="ps_name">Tiêu đề trang:</label>
        <input type="text" class="form-control" required placeholder="Tiêu đề trang" value="{{ old('ps_name',isset($pageStatics->ps_name) ? $pageStatics->ps_name : '') }}" name="ps_name">
    </div>

    <div class="form-group">
        <label for="a_name">Chọn trang:</label>
        <select name="type" class="form-control">
            <option value="1" >Về chúng tôi</option>
            <option value="2" >Thông tin giao hàng</option>
            <option value="3" >Chính sách bảo mật</option>
            <option value="4" >Điều khoản sử dụng</option>
        </select>
    </div>

    <div class="form-group">
        <label for="ps_content">Nội dung:</label>
        <textarea name="ps_content" class="form-control"  id="pro_content" cols="30" rows="3" placeholder="Nội dung bài viết">{{ old('ps_content',isset($pageStatics->ps_content) ? $pageStatics->ps_content : '') }}</textarea>
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