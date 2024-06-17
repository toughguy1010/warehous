@extends('layouts.app')
@section('content')
    <div class="header-content">
        <h3>
            Danh sách đơn hàng nhập
        </h3>
        <form class="search-box">
            <input type="text" class="form-control" placeholder="Nhập mã đơn hàng" name="search">
            <button class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path
                        d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6 .1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z" />
                </svg>
            </button>
        </form>
    </div>
    <table class="table cs-table ">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Mã đơn hàng</th>
                <th scope="col">Tổng tiền</th>
                <th scope="col">Ngày nhập</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Thao tác</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $key => $order)
                <tr>
                    <td>
                        {{ $key + 1 }}
                    </td>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ showPrice($order->amount) }}</td>
                    <td>{{ $order->getDate() }}</td>
                    <td>
                        <form action="{{ route('import.change-status', $order->id) }}" method="POST">
                            @csrf
                            <select class="form-select" name="order_status" id="order_status" onchange="this.form.submit()">
                                <option value="0" {{ $order->order_status == 0 ? 'selected' : '' }}>Chưa thanh toán
                                </option>
                                <option value="1" {{ $order->order_status == 1 ? 'selected' : '' }}>Đã thanh toán
                                </option>
                            </select>
                        </form>
                    </td>
                    <td>
                        <div class="d-flex justify-content-center" style="gap: 10px">
                            <a href="{{ route('import.detail', $order->id) }}" class="btn btn-primary"> Chi tiết </a>
                            <form action="{{ route('import.delete', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Bạn có muốn xóa đơn hàng này không?');">Xóa</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $orders->links('vendor.pagination.bootstrap-5') }}
@endsection
