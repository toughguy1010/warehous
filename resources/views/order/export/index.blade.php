@extends('layouts.app')
@section('content')
    <h3>
        Đơn hàng nhập
    </h3>
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
                        <form action="{{ route('export.change-status', $order->id) }}"  method="POST">
                            @csrf
                            <select name="order_status" id="order_status" onchange="this.form.submit()">
                                <option value="0" {{ $order->order_status == 0 ? 'selected' : '' }}>Chưa thanh toán</option>
                                <option value="1" {{ $order->order_status == 1 ? 'selected' : '' }}>Đã thanh toán</option>
                                <!-- Add more status options as needed -->
                            </select>
                        </form>
                        {{-- {{ $order->getStatus() }} --}}
                    </td>
                    <td>
                        <div class="d-flex justify-content-center" style="gap: 10px">
                            <a href="{{ route('export.detail', $order->id) }}" class="btn btn-primary"> Chi tiết </a>
                            <form action="{{ route('export.delete', $order->id) }}" method="POST"
                                style="display:inline;">
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
