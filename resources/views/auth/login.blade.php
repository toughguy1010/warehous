@extends('layouts.app')

@section('content')
    <style>
        .navbar {
            display: none;
        }
        #side_bar{
            display: none;

        }
    </style>
    <div class="container login-container">
        <div class="row justify-content-center login-form-wrap" >
            <div class="col-md-7 login-bg">
                <img src="{{ asset('images/login-bg.jpg') }}" alt="">
            </div>
            <div class="col-md-5 login-form">
                <div class="form-header">
                    <h3 class="text-center">
                        Đăng nhập
                    </h3>
                    <span class="">
                        Warehouse - Quản lý kho thông minh, tối ưu vận hành
                    </span>
                </div>
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="row mb-3 justify-content-center">
                        <div class="col-md-10">
                            <input id="email" type="email" class=" cs-input form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3 justify-content-center">
                        

                        <div class="col-md-10">
                            <input id="password" type="password"
                                class="cs-input form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password" placeholder="Mật khẩu">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3 justify-content-center">
                        <div class="col-md-10 row justify-content-between">
                            <div class="form-check col-md-6">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    Lưu mật khẩu
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                            <div class="" style="flex: 50%; padding:0;text-align:end">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Quên mật khẩu
                                </a>
                            </div>
                            @endif
                            
                        </div>
                        
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Đăng nhập
                            </button>

                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
