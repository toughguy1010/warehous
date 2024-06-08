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
                    <td>{{showPrice($order->amount)  }}</td>
                    <td>{{  $order->getDate()  }}</td>
                    <td>{{ $order->getStatus() }}</td>
                    <td>
                        <div class="d-flex justify-content-center" style="gap: 10px">
                            {{-- <a href="{{ route('product.update', $product->id) }}" class="btn btn-primary"> Sửa </a>
                            <form action="{{ route('product.delete', $product->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Bạn có muốn xóa hàng hóa này không?');">Xóa</button>
                            </form> --}}
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $orders->links('vendor.pagination.bootstrap-5') }}
@endsection
