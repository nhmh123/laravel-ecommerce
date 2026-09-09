@extends('admin.layouts.auth')

@section('title', 'Quên mật khẩu')

@section('content')
<div class="login-box w-50">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="{{ route('admin.dashboard') }}" class="h1"><b>Admin</b>LTE</a>
        </div>
        <div class="card-body">
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5>
                    <i class="icon fas fa-ban"></i>
                    Gửi yêu cầu thất bại!
                </h5>
                {{ $errors->first() }}
            </div>
            @endif

            <p class="login-box-msg">Bạn chỉ còn một bước nữa để tạo mật khẩu mới. Hãy khôi phục mật khẩu ngay bây giờ.</p>
            <form action="{{ route('password.update') }}" method="post">
                @csrf
                <input type="hidden" name="email" value="{{ request()->email }}">
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Nhập mật khẩu mới" name="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Xác nhận mật khẩu mới" name="password_confirmation">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Thay đổi mật khẩu</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <p class="mt-3 mb-1">
                <a href="{{ route('admin.login') }}">Đăng nhập</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->
@endsection