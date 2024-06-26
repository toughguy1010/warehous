@extends('layouts.app')
@section('content')
    <form class="cs-form" action="{{ route('export.store') }}" method="post" style="max-width: 1050px" enctype="multipart/form-data">
        @csrf
        <h3 class="form-title mb-4 text-center">
            Thêm mới đơn hàng xuất
        </h3>
        <p class="fw-bolder" style="color:#2c90fb; font-size: 18px">Chi tiết đơn hàng</p>
        <div class="row mb-3">
            @if (auth()->user()->isAdmin())
                <div class=" col-6">
                    <label for="nameuser" class="form-label">Khách hàng <span class="required">*</span></label>
                    <select class="form-select" aria-label="Default select example" name="customer_id">
                        <option value="">--Chọn khách hàng---</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}"> {{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class=" col-6">
                    <label for="nameuser" class="form-label">Nhân viên <span class="required">*</span></label>
                    <select class="form-select" aria-label="Default select example" name="user_id">
                        <option value="">--Chọn nhân viên---</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}"> {{ $employee->name }}</option>
                        @endforeach
                    </select>
                </div>
            @else
                <div class=" col-6">
                    <label for="nameuser" class="form-label">Khách hàng <span class="required">*</span></label>
                    <select class="form-select" aria-label="Default select example" name="customer_id">
                        <option value="">--Chọn Khách hàng---</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}"> {{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            @endif

        </div>


        <div class="row mb-5">
            <div class=" col-6">
                <label for="nameuser" class="form-label">Ngày nhập <span class="required">*</span></label>
                <input type="date" class="form-control" name="order_date" value=""
                    placeholder="Ngày nhập đơn hàng">
            </div>
            <div class=" col-6">
                <label for="nameuser" class="form-label">Trạng thái đơn hàng <span class="required">*</span></label>
                <select class="form-select" aria-label="Default select example" name="status">
                    <option value="">--Chọn trạng thái---</option>
                    <option value="1">Đã thanh toán</option>
                    <option value="0">Chưa thanh toán</option>
                </select>
            </div>

        </div>
        <p class="fw-bolder" style="color:#2c90fb; font-size: 18px">Chi tiết hàng hóa
            {{-- <span class="show-modal btn btn-outline-secondary btn-sm" data-url="{{ route('product.create') }}">
                Thêm hàng hóa
            </span> --}}

        </p>

        <div class="row mb-5">
            <div class=" col-4">
                <label for="nameuser" class="form-label">Hàng hóa sẵn có <span class="required">*</span></label>
                <select class="form-select " aria-label="Default select example" id=product-arr>
                    <option value="">--Chọn hàng hóa---</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}"> {{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class=" col-4">
                <label for="nameuser" class="form-label">Số lượng <span class="required">*</span></label>
                <input type="number" class="form-control" name="stock" value=""
                    placeholder="Nhập số lượng hàng hóa" id="stock">
            </div>
            <div class=" col-4">
                <div class="select-product-export btn btn-outline-primary" style="margin-top: 30px;"
                    data-url="{{ route('product.get-product', ['id' => '']) }}" data-type="export"> Chọn hàng hóa</div>
            </div>
        </div>

        <p class="fw-bolder" style="color:#2c90fb; font-size: 18px">Danh sách hàng hóa
        </p>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Sản phẩm</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Đơn giá bán</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Thành tiền</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody class="item-product-order">
            </tbody>
        </table>


        <button class="btn btn-primary right-btn">Tạo đơn nhập hàng hóa</button>
    </form>

@endsection
