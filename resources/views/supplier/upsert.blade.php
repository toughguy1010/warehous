@extends('layouts.app')
@section('content')
    <form class="cs-form" action="{{ route('supplier.upsert.store', ['id' => isset($supplier) ? $supplier->id : null]) }}"
        method="post">
        @csrf
        <h3 class="form-title mb-4 text-center">
            {{ isset($supplier) ? 'Cập nhật' : 'Thêm mới' }} nhà cung cấp
        </h3>
        <div class="mb-3">
            <label for="namesupplier" class="form-label">Tên nhà cung cấp <span class="required">*</span></label>
            <input type="text" class="form-control" name="name"
                value="{{ isset($supplier) ? $supplier->name : '' }}" placeholder="Nhập tên nhà cung cấp">
        </div>
        <div class="mb-3">
            <label for="namesupplier" class="form-label">Email </label>
            <input type="text" class="form-control" name="email"
                value="{{ isset($supplier) ? $supplier->email : '' }}" placeholder="Nhập email nhà cung cấp">
        </div>
        <div class="mb-3">
            <label for="namesupplier" class="form-label">Số điện thoại </label>
            <input type="text" class="form-control" name="phone"
                value="{{ isset($supplier) ? $supplier->phone : '' }}" placeholder="Nhập số điện thoại nhà cung cấp">
        </div>
        <div class="mb-3">
            <label for="namesupplier" class="form-label">Địa chỉ </label>
            {{-- <input type="text" class="form-control" name="address"
                value="{{ isset($supplier) ? $supplier->address : '' }}" placeholder="Nhập địa chỉ nhà cung cấp"> --}}
                <textarea class="form-control" name="address" style="height: 100px">
                    {{ isset($supplier) ? $supplier->address : 'Nhập địa chỉ nhà cung cấp' }}
                </textarea>
        </div>
        <button type="submit" class="btn btn-primary "> {{ isset($supplier) ? 'Cập nhật' : 'Thêm ' }}</button>
    </form>
@endsection
