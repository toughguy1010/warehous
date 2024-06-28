@extends('layouts.app')
@section('content')
    <div class="detail-header d-flex align-items-baseline" style="gap: 20px">
        <h4 style="text-decoration: underline">
            Thông tin đơn hàng
        </h4>
        <a href="{{ route('import.pdf', $order->id) }}" class="btn btn-outline-primary">Xuất PDF</a>
    </div>
    <div class="row my-3">
        <div class="col-4">
            <table class=" cs-table-2" style="width: 100%">
                <tbody>
                    <tr>
                        <td> <strong>Nhà cung cấp:</strong> </td>
                        <td>{{ $order->supplier->name }}</td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                Nhân viên tạo đơn:
                            </strong>
                        </td>
                        <td>{{ $order->user->name }}</td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                Ngày tạo đơn:
                            </strong>
                        </td>
                        <td>{{ $order->getDate() }}</td>
                    </tr>

                    <tr>
                        <td>
                            <strong>
                                Ngày tạo đơn:
                            </strong>
                        </td>
                        <td>{{ $order->getDate() }}</td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                Tổng thành tiền:
                            </strong>
                        </td>
                        <td>{{ showPrice($order->amount) }}</td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                Trạng thái:
                            </strong>
                        </td>
                        <td>{{ $order->getStatus() }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <h4 style="text-decoration: underline">
        Chi tiết đơn hàng
    </h4>

    <table class="table cs-table ">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Ảnh sản phẩm</th>
                <th scope="col">Đơn giá</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $key => $item)
                @if ($item->product !== null)
                    <tr>
                        <td>
                            {{ $key + 1 }}
                        </td>
                        <td>
                            {{ $item->product->name }}
                        </td>
                        <td>
                            <img src="{{ showImage($item->product->avatar) }}" alt="" class="product_img">
                        </td>
                        <td>
                            {{ showPrice($item->single_price) }}
                        </td>
                        <td>
                            {{ $item->quantity }}
                        </td>
                        <td>
                            {{ showPrice($item->total_price) }}
                        </td>
                    </tr>
                @else
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>Sản phẩm này đã bị xóa hoặc không tồn tại</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('import.index') }}" class="btn btn-primary return-btn mb-5">Quay lại</a>
@endsection
