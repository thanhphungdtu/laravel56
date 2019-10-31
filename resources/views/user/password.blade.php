@extends('user.layout')
@section('content')
    <h1 class="page-header">Cập nhật mật khẩu</h1>
    <div class="row">
        <div class="col-sm-12">
            <form action="" method="post">
                @csrf
                <div class="form-group" style="position: relative">
                    <label for="email">Mật khẩu cũ:</label>
                    <input type="password" class="form-control" placeholder="*******" name="old_password" value="">
                    <a style="position: absolute;top: 54%;right: 10px;color: #333" href="javascript:void(0)"><i class="fa fa-eye"></i></a>
                    @if($errors->has('old_password'))
                        <div class="error-text">
                            {{$errors->first('old_password')}}
                        </div>
                    @endif
                </div>
                <div class="form-group" style="position: relative">
                    <label for="email">Mật khẩu mới:</label>
                    <input type="password" class="form-control" placeholder="*******" name="password" value="">
                    <a style="position: absolute;top: 54%;right: 10px;color: #333" href="javascript:void(0)"><i class="fa fa-eye"></i></a>
                    @if($errors->has('password'))
                        <div class="error-text">
                            {{$errors->first('password')}}
                        </div>
                    @endif
                </div>
                <div class="form-group" style="position: relative">
                    <label for="email">Nhập lại Mật khẩu mới:</label>
                    <input type="password" class="form-control" placeholder="*******" name="password_confirm" value="">
                    <a style="position: absolute;top: 54%;right: 10px;color: #333" href="javascript:void(0)"<i class="fa fa-eye"></i></a>
                    @if($errors->has('password_confirm'))
                        <div class="error-text">
                            {{$errors->first('password_confirm')}}
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Cập nhật</button>
            </form>
        </div>
    </div>
@stop
@section('script')
    <script>
        $(function () {
            $(".form-group a").click(function () {
                let $this = $(this);

                if ($this.hasClass('active'))
                {
                    $this.parents('.form-group').find('input').attr('type','password');
                    $this.removeClass('active');
                }else
                {
                    $this.parents('.form-group').find('input').attr('type','text');
                    $this.addClass('active');
                }
            });
        });
    </script>
@stop