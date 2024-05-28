@extends('layouts.app')
@section('content')
    <form class="cs-form" action="{{ route('product.upsert.store', ['id' => isset($product) ? $product->id : null]) }}"
        method="post">
        @csrf
        <h3 class="form-title mb-4 text-center">
            {{ isset($product) ? 'Cập nhật' : 'Thêm mới' }} Sẩn phẩm
        </h3>
        <div class="mb-3">
            <label for="nameproduct" class="form-label">Tên sản phẩm <span class="required">*</span></label>
            <input type="text" class="form-control" name="name"
                value="{{ isset($product) ? $product->name : '' }}" placeholder="Nhập tên khách hàng">
        </div>
        <div class="mb-3">
            <label for="namecustomer" class="form-label">Mô tả sản phẩm </label>
            <input type="text" class="form-control" name="description"
                value="{{ isset($product) ? $product->description : '' }}" placeholder="Nhập mô tả sản phẩm">
        </div>
        <div class="mb-3">
            <label for="namecustomer" class="form-label">Giá sản phẩm </label>
            <input type="text" class="form-control" name="price"
                value="{{ isset($product) ? $product->price : '' }}" placeholder="Nhập số điện thoại khách hàng">
        </div>
    
        <button type="submit" class="btn btn-primary "> {{ isset($product) ? 'Cập nhật' : 'Thêm ' }}</button>
    </form>
@endsection
