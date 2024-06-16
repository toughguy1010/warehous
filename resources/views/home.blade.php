@extends('layouts.app')

@section('content')
    <div class="row justify-content-start cs-dashboard my-5">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header text-center">Tổng hàng hóa</div>
                <a class="card-body" href="{{ route('product.index') }}" target="_blank">
                    {{ $total_product }}
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header text-center">Sản phẩm tồn kho</div>
                <div class="card-body show-stock" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    {{ $totalStock }}
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header text-center">Tổng đơn nhập</div>
                <a class="card-body" href="{{ route('import.index') }}" target="_blank">
                    {{ $total_import }}

                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header text-center">Tổng đơn xuất</div>
                <a class="card-body" href="{{ route('export.index') }}" target="_blank">
                    {{ $total_export }}

                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-4 filter-dashboard">
            <div class="col-md-3">
                <form action="{{ route('home') }}" method="GET">
                    <label for="filter " class="mb-2">Thống kê theo tháng :</label>
                    <select class="form-select  " name="filter" id="filter" onchange="this.form.submit()">
                        <option value="" {{ $filter == 'year' ? 'selected' : '' }}>---Chọn tháng---</option>

                        @php
                            $months = [
                                1 => 'Tháng một',
                                2 => 'Tháng hai',
                                3 => 'Tháng ba',
                                4 => 'Tháng tư',
                                5 => 'Tháng năm',
                                6 => 'Tháng sáu',
                                7 => 'Tháng bảy',
                                8 => 'Tháng tám',
                                9 => 'Tháng chín',
                                10 => 'Tháng mười',
                                11 => 'Tháng mười một',
                                12 => 'Tháng mười hai',
                            ];
                        @endphp
                        @for ($i = 1; $i <= 12; $i++)
                            @php
                                $month = sprintf('%02d', $i);
                                $selected = $i == $date->month ? 'selected' : '';

                            @endphp
                            <option value="{{ $month }}" {{ $selected }}>{{ $months[$i] }}</option>
                        @endfor
                    </select>
                </form>
            </div>
            <div class="col-md-2" style="width: 14.666667%">
                <form action="{{ route('home') }}" method="GET">
                    <input type="hidden" name="filter" value="year">
                    <button class="btn btn-outline-primary">Doanh thu của năm</button>
                </form>
            </div>

        </div>
        <div class="col-md-8">
            <h5>Doanh thu đơn nhập</h5>
            <canvas id="importChart"></canvas>
            <p class="text-center my-4">Bảng thống kê doanh thu đơn nhập theo tháng</p>
        </div>
        <div class="col-md-4">
            <p class=" my-4">Tổng doanh thu: {{ showPrice($totalImportRevenue) }}</p>
            <ul class="ps-0">
                @foreach ($importRevenue as $revenue)
                    <li style="list-style-type: none" class="mt-2">{{ $revenue->date }}:
                        {{ showPrice($revenue->total) }}</li>
                @endforeach
            </ul>
        </div>

        <div class="col-md-8">
            <h5>Doanh thu đơn xuất</h5>
            <canvas id="exportChart"></canvas>
            <p class="text-center my-4">Bảng thống kê doanh thu đơn xuất theo tháng</p>

        </div>
        <div class="col-md-4">
            <p class=" my-4">Tổng doanh thu: {{ showPrice($totalExportRevenue) }}</p>
            <ul class="ps-0">
                @foreach ($exportRevenue as $revenue)
                    <li style="list-style-type: none" class="mt-2">{{ $revenue->date }}:
                        {{ showPrice($revenue->total) }}</li>
                @endforeach
            </ul>
        </div>

    </div>
   @include('home-model')
    @include('home-script')
@endsection
