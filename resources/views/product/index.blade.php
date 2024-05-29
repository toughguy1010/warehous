@extends('layouts.app')
@section('content')
    <h3>
        Sản phẩm
    </h3>
    <table class="table cs-table ">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Ảnh</th>
                <th scope="col">Giá bán</th>
                <th scope="col">Giá mua</th>
                <th scope="col">Thao tác</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($products as $key => $product)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $product->name }}</td>
                    <td>
                        <img src="{{ showImage($product->avatar) }}" alt="" class="product_img">
                    </td>
                    <td>{{ showPrice($product->purchase_price)  }}</td>
                    <td>{{ showPrice($product->selling_price) }}</td>
                    <td>
                        <div class="d-flex justify-content-center" style="gap: 10px">
                            <a href="{{ route('product.update', $product->id) }}" class="btn btn-primary"> Sửa </a>
                            <form action="{{ route('product.delete', $product->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Bạn có muốn xóa sản phẩm này không?');">Xóa</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $products->links('vendor.pagination.bootstrap-5') }}
@endsection
