@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Đổi mật khẩu</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('password.change.store') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="current_password" class="col-md-4 col-form-label text-md-end">Nhập mật khẩu
                                    cũ</label>

                                <div class="col-md-6">
                                    <input id="current_password" type="password"
                                        class="form-control @error('current_password') is-invalid @enderror"
                                        name="current_password" required autocomplete="current_password">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="new_password" class="col-md-4 col-form-label text-md-end">Nhập mật khẩu
                                    mới</label>

                                <div class="col-md-6">
                                    <input id="new_password" type="password"
                                        class="form-control @error('new_password') is-invalid @enderror" name="new_password"
                                        required autocomplete="new_password">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="confirmed" class="col-md-4 col-form-label text-md-end">Nhập lại mật khẩu
                                    mới</label>

                                <div class="col-md-6">
                                    <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation" required
                                        autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Lưu lại
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
