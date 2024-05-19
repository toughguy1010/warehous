@extends('layouts.app')
@section('content')
    <h3>
        Danh sách nhà cung cấp
    </h3>
    <table class="table cs-table ">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tên nhà cung cấp</th>
                <th scope="col">Email</th>
                <th scope="col">Số điện thoại</th>
                <th scope="col">Địa chỉ</th>
                <th scope="col">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suppliers as $supplier)
                <tr>
                    <td>{{ $supplier->id }}</td>
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->email }}</td>
                    <td>{{ $supplier->phone }}</td>
                    <td>
                        <p class="short-text">
                            {{ $supplier->address }}
                        </p>
                    </td>
                    <td>
                        <div class="d-flex justify-content-center" style="gap: 10px">
                            <a href="{{ route('supplier.update', $supplier->id) }}" class="btn btn-primary"> Sửa </a>
                            <form action="{{ route('supplier.delete', $supplier->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa nhà cung cấp này không?');">Xóa</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $suppliers->links('vendor.pagination.bootstrap-5') }}
@endsection
