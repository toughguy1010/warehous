@extends('layouts.app')
@section('content')
    <form class="cs-form" action="{{ route('product.upsert.store', ['id' => isset($product) ? $product->id : null]) }}"
        method="post" style="max-width: 950px" enctype="">
        @csrf
        <h3 class="form-title mb-4 text-center">
            {{ isset($product) ? 'Cập nhật' : 'Thêm mới' }} Sẩn phẩm
        </h3>
        <div class="row mb-3">
            <div class=" col-6">
                <label for="nameproduct" class="form-label">Tên sản phẩm <span class="required">*</span></label>
                <input type="text" class="form-control" name="name"
                    value="{{ isset($product) ? $product->name : '' }}" placeholder="Nhập tên sản phẩm">
            </div>
            <div class="col-6">
                <label for="namecustomer" class="form-label">Mô tả sản phẩm </label>
                <input type="text" class="form-control" name="description"
                    value="{{ isset($product) ? $product->description : '' }}" placeholder="Nhập mô tả sản phẩm">
            </div>
        </div>

        <div class="row mb-3">
            <div class=" col-6">
                <label for="nameproduct" class="form-label">Giá mua <span class="required">*</span></label>
                <input type="text" class="form-control" name="name"
                    value="{{ isset($product) ? $product->purchase_price : '' }}" placeholder="Nhập tên sản phẩm">
            </div>
            <div class="col-6">
                <label for="namecustomer" class="form-label">Giá bán <span class="required">*</span></label>
                <input type="text" class="form-control" name="description"
                    value="{{ isset($product) ? $product->selling_price : '' }}" placeholder="Nhập mô tả sản phẩm">
            </div>
        </div>
        <div class="row mb-3">
            <div class=" col-6">
                <label for="nameproduct" class="form-label">Nhà cung cấp </label>
                <select class="form-select" aria-label="Default select example" name="supplier_id">
                    <option value="">--Chọn nhà cung cấp---</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}"
                            {{ isset($product) && $product->supplier_id !== null && $product->supplier_id == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class=" col-6">
                <label for="nameproduct" class="form-label">Đơn vị </label>
                <select class="form-select" aria-label="Default select example" name="unit_id">
                    <option value="">--Chọn đơn vị---</option>
                    @foreach ($units as $unit)
                        <option value="{{ $unit->id }}"
                            {{ isset($product) && $product->unit_id !== null && $product->unit_id == $unit->id ? 'selected' : '' }}>
                            {{ $unit->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-6">
                <label for="namecustomer" class="form-label">Số lượng sản phẩm </label>
                <input type="text" class="form-control" name="stock"
                    value="{{ isset($product) ? $product->stock : '' }}" placeholder="Nhập số lượng sản phẩm">
            </div>
            <div class=" col-6">
                <label for="formFile" class="form-label">Ảnh đại diện</label>
                <input class="form-control" type="file" id="upload" name="file" data-url="{{ route('upload.services') }}">
                @if ($product)
                <div id="preview">
                    <a href="">
                        <img src="{{ $product->avatar }}" alt="">
                    </a>
                </div>
                <input type="hidden" id="file" name="avatar" value="{{ $product->avatar }}">
                @else
                <div id="preview">

                </div>
                <input type="hidden" id="file" name="avatar">
                @endif
                
            </div>
        </div>

        <button type="submit" class="btn btn-primary "> {{ isset($product) ? 'Cập nhật' : 'Thêm ' }}</button>
    </form>
@endsection
