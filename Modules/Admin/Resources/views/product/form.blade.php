<div class="col-sm-8">
<form action="" method="post" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="email">Loại sản phẩm:</label>
        <select name="pro_category_id" id="" class="form-control">
            <option value="">--Chọn loại sản phẩm--</option>
            @if(isset($categories))
                @foreach($categories as $category)
                    <option value="{{$category->id}}" {{ old('pro_category_id',isset($product->pro_category_id) ? $product->pro_category_id : '') == $category->id ? "selected='selected'" : ""  }} >{{$category->c_name}}</option>
                @endforeach
            @endif
        </select>
        @if($errors->has('pro_category_id'))
            <div class="error-text">
                {{$errors->first('pro_category_id')}}
            </div>
        @endif
    </div>

    <div class="form-group">
        <label for="pro_name">Tên sản phẩm:</label>
        <input type="text" class="form-control"  placeholder="Tên sản phẩm" value="{{ old('pro_name',isset($product->pro_name) ? $product->pro_name : '') }}" name="pro_name">
        @if($errors->has('pro_name'))
            <div class="error-text">
                {{$errors->first('pro_name')}}
            </div>
        @endif
    </div>

    <div class="form-group">
        <label for="pro_price">Giá sản phẩm:</label>
        <input type="number" name="pro_price" placeholder="Giá sản phẩm" class="form-control" value="{{ old('pro_price',isset($product->pro_price) ? $product->pro_price : '') }}">
        @if($errors->has('pro_price'))
            <div class="error-text">
                {{$errors->first('pro_price')}}
            </div>
        @endif
    </div>

    <div class="form-group">
        <label for="pro_description">Mô tả:</label>
        <textarea name="pro_description" class="form-control" id="" cols="30" rows="3" placeholder="Mô tả ngắn sản phẩm">{{ old('pro_description',isset($product->pro_description) ? $product->pro_description : '') }}</textarea>
        @if($errors->has('pro_description'))
            <div class="error-text">
                {{$errors->first('pro_description')}}
            </div>
        @endif
    </div>

    <div class="form-group">
        <label for="pro_content">Nội dung:</label>
        <textarea name="pro_content" class="form-control" id="pro_content" cols="30" rows="3" placeholder="Nội dung sản phẩm">{{ old('pro_content',isset($product->pro_content) ? $product->pro_content : '') }}</textarea>
        @if($errors->has('pro_content'))
            <div class="error-text">
                {{$errors->first('pro_content')}}
            </div>
        @endif
    </div>

    <div class="form-group">
        @if(isset($product->pro_avatar))
        <p><img src="{{ pare_url_file($product->pro_avatar) }}" alt="" style="width: 80px;"><img src="{{ asset('/public/theme_admin/images/default-image.jpg') }}" id="out_img" alt="" width="80px" height="80px"></p>
        @endif
    </div>
    
    <div class="form-group">
        <label for="avatar">Avatar:</label>
        <input type="file" name="avatar" id="input_img" class="form-control">
    </div>

    <div class="form-group">
        <label for="pro_sale">% khuyến mãi:</label>
        <input type="number" name="pro_sale" placeholder="% giảm giá" class="form-control" value="{{ old('pro_sale',isset($product->pro_sale) ? $product->pro_sale : '0') }}">
    </div>

    <div class="form-group">
        <label for="pro_sale">Số lượng sản phẩm:</label>
        <input type="number" name="pro_number"  class="form-control" value="{{ old('pro_number',isset($product->pro_number) ? $product->pro_number : '0') }}">
    </div>

    <div class="form-group">
        <label for="pro_title_seo">Meta title:</label>
        <input type="text" class="form-control"  placeholder="Meta Title" value="{{ old('pro_title_seo',isset($product->pro_title_seo) ? $product->pro_title_seo : '') }}" name="pro_title_seo">
    </div>

    <div class="form-group">
        <label for="pro_description_seo">Meta Description:</label>
        <input type="text" class="form-control"  placeholder="Meta Description" value="{{ old('pro_description_seo',isset($product->pro_description_seo) ? $product->pro_description_seo : '') }}" name="pro_description_seo">
    </div>

    <div class="form-group">
        <div class="checkbox">
            <label><input type="checkbox" name="pro_hot">Nổi bật</label>
        </div>
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