@extends('layouts.app')
@section('content')
    <h3>
       Sản phẩm
    </h3>
    <table class="table cs-table ">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Mô tả sản phẩm</th>
                <th scope="col">Giá</th>
                <th scope="col">Ngày tạo</th>
                <th scope="col">Ngày chỉnh sửa</th>
                <th scope="col">Thao tác</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($product as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->created_at }}</td>
                    <td>{{ $product->updated_at }}</td>
                    <td>
                        <div class="d-flex justify-content-center" style="gap: 10px">
                            <a href="{{ route('product.update', $product->id) }}" class="btn btn-primary"> Sửa </a>
                            <form action="{{ route('product.delete', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa sản phẩm này không?');">Xóa</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $product->links('vendor.pagination.bootstrap-5') }}
@endsection
