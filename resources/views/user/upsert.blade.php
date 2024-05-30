@extends('layouts.app')
@section('content')
    <form class="cs-form" action="{{ route('user.upsert.store', ['id' => isset($user) ? $user->id : null]) }}" method="post"
        style="max-width: 950px" enctype="multipart/form-data">
        @csrf
        <h3 class="form-title mb-4 text-center">
            {{ isset($user) ? 'Cập nhật' : 'Thêm mới' }} tài khoản
        </h3>
        <div class="row mb-3">
            <div class=" col-12">
                <label for="nameuser" class="form-label">Tên người dùng <span class="required">*</span></label>
                <input type="text" class="form-control" name="name" value="{{ isset($user) ? $user->name : '' }}"
                    placeholder="Nhập tên người dùng">
            </div>
        </div>

        <div class="row mb-3">
            <div class=" col-6">
                <label for="nameuser" class="form-label">Email <span class="required">*</span></label>
                <input type="text" class="form-control" name="email" value="{{ isset($user) ? $user->email : '' }}"
                    placeholder="Nhập email">
            </div>
            @if (!$user)
                <div class="col-6">
                    <label for="namecustomer" class="form-label">Mật khẩu <span class="required">*</span></label>
                    <input type="password" class="form-control" name="password" value="" placeholder="Nhập mật khẩu">
                </div>
            @endif
        </div>
        <div class="row mb-3">
            <div class=" col-6">
                <label for="nameuser" class="form-label">Số điện thoại </label>
                <input type="text" class="form-control" name="phone" value="{{ isset($user) ? $user->phone : '' }}"
                    placeholder="Nhập số điện thoại">
            </div>
            <div class="col-6">
                <label for="namecustomer" class="form-label">Địa chỉ </label>
                <input type="text" class="form-control" name="address" value="" placeholder="Nhập địa chỉ">
            </div>
        </div>
        <div class="row mb-3">
            <div class=" col-6">
                <label for="nameuser" class="form-label">Trạng thái </label>
                <select class="form-select" aria-label="Default select example" name="supplier_id">
                    <option value="">--Chọn nhà Trạng thái---</option>
                    <option value="1" {{ isset($user) && $user->status === 1 ? 'selected' : '' }}> Hoạt động </option>
                    <option value="0" {{ isset($user) && $user->status === 0 ? 'selected' : '' }}> Dừng hoạt động
                    </option>
                </select>
            </div>
            <div class=" col-6">
                <label for="nameuser" class="form-label"> Chức vụ <span class="required">*</span></label>
                <select class="form-select" aria-label="Default select example" name="unit_id">
                    <option value="">---Chọn chức vụ---</option>
                    <option value="admin" {{ isset($user) && $user->type === 'admin' ? 'selected' : '' }}> Quản trị viên </option>
                    <option value="employee" {{ isset($user) && $user->type === 'employee' ? 'selected' : '' }}> Nhân viên </option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class=" col-6">
                <label for="formFile" class="form-label">Ảnh đại diện</label>
                <input class="form-control" type="file" id="upload" name="file"
                    data-url="{{ route('upload.services') }}">
                @if ($user)
                    <div id="preview">
                        <a href="">
                            <img src="{{ $user->avatar }}" alt="">
                        </a>
                    </div>
                    <input type="hidden" id="file" name="avatar" value="{{ $user->avatar }}">
                @else
                    <div id="preview">

                    </div>
                    <input type="hidden" id="file" name="avatar">
                @endif

            </div>
        </div>

        <button type="submit" class="btn btn-primary "> {{ isset($user) ? 'Cập nhật' : 'Thêm ' }}</button>
    </form>
@endsection
