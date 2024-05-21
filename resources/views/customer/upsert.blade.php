@extends('layouts.app')
@section('content')
    <form class="cs-form" action="{{ route('customer.upsert.store', ['id' => isset($customer) ? $customer->id : null]) }}"
        method="post">
        @csrf
        <h3 class="form-title mb-4 text-center">
            {{ isset($customer) ? 'Cập nhật' : 'Thêm mới' }} khách hàng
        </h3>
        <div class="mb-3">
            <label for="namecustomer" class="form-label">Tên khách hàng <span class="required">*</span></label>
            <input type="text" class="form-control" name="name"
                value="{{ isset($customer) ? $customer->name : '' }}" placeholder="Nhập tên khách hàng">
        </div>
        <div class="mb-3">
            <label for="namecustomer" class="form-label">Email </label>
            <input type="text" class="form-control" name="email"
                value="{{ isset($customer) ? $customer->email : '' }}" placeholder="Nhập email khách hàng">
        </div>
        <div class="mb-3">
            <label for="namecustomer" class="form-label">Số điện thoại </label>
            <input type="text" class="form-control" name="phone"
                value="{{ isset($customer) ? $customer->phone : '' }}" placeholder="Nhập số điện thoại khách hàng">
        </div>
        <div class="mb-3">
            <label for="namecustomer" class="form-label">Địa chỉ </label>
            {{-- <input type="text" class="form-control" name="address"
                value="{{ isset($customer) ? $customer->address : '' }}" placeholder="Nhập địa chỉ khách hàng"> --}}
                <textarea class="form-control" name="address" style="height: 100px">
                    {{ isset($customer) ? $customer->address : 'Nhập địa chỉ khách hàng' }}
                </textarea>
        </div>
        <button type="submit" class="btn btn-primary "> {{ isset($customer) ? 'Cập nhật' : 'Thêm ' }}</button>
    </form>
@endsection
