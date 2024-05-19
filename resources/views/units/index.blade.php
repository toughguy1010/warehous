@extends('layouts.app')
@section('content')
    <h3>
        Danh sách đơn vị
    </h3>
    <table class="table cs-table ">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tên đơn vị</th>
                <th scope="col">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($units as $unit)
                <tr>
                    <td>{{ $unit->id }}</td>
                    <td>{{ $unit->name }}</td>
                    <td>
                        <div class="d-flex justify-content-center" style="gap: 10px">
                            <a href="{{ route('unit.update', $unit->id) }}" class="btn btn-primary"> Sửa </a>
                            <form action="{{ route('unit.delete', $unit->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa đơn vị này không?');">Xóa</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $units->links('vendor.pagination.bootstrap-5') }}
@endsection
