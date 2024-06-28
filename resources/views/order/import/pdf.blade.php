<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiet don hang</title>
    <!-- Include any necessary CSS here -->
    <style>
        /* Define your styles for the PDF */
        body {
            font-family: 'DejaVu Sans', sans-serif;
        }
        /* Example styles */
        .order-details {
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h1>Chi tiết đơn hàng</h1>

    <div class="order-details">
        <p><strong>Nhà cung cấp:</strong> {{ $order->supplier->name }}</p>
        <p><strong>Nhân viên tạo đơn:</strong> {{ $order->user->name }}</p>
        <p><strong>Ngày tạo đơn:</strong> {{ $order->created_at->format('d/m/Y') }}</p>
        <p><strong>Tổng thành tiền:</strong> {{ showPrice($order->amount) }} VND</p>
        <p><strong>Trạng thái:</strong> {{ $order->getStatus() }}</p>
    </div>

    <h2>Chi tiết đơn hàng</h2>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Đơn giá</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $key => $item)
                @if ($item->product)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ showPrice($item->single_price) }} VND</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ showPrice($item->total_price) }} VND</td>
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

    <!-- Mục để người dùng có thể kí -->
    <div>
        <p><strong>Người nhận hàng:</strong> ____________________________</p>
        <!-- Có thể thêm hướng dẫn để người dùng kí vào đây -->
    </div>
</body>
</html>
