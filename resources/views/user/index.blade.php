@extends('layouts.app')
@section('content')
    <h3>
        Danh sách tài khoản
    </h3>
    <style>
    
    </style>
    <table class="table cs-table ">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên người dùng</th>
                <th scope="col">Ảnh đại diện</th>
                <th scope="col">Chức vụ</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $key => $user)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>
                        <img src="{{ showImage($user->avatar) }}" alt="" class="product_img">
                    </td>
                    <td>{{ $user->getTextType($user->type) }}</td>
                    <td>
                        <span class="{{ $user->status == 1 ? 'status-active' : 'status-deactive' }}">
                            {{ $user->getTextStatus($user->status) }}
                        </span>
                    </td>

                    <td>
                        <div class="d-flex justify-content-center" style="gap: 10px">
                            <a href="{{ route('user.update', $user->id) }}" class="btn btn-primary"> Sửa </a>
                            <form action="{{ route('user.delete', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Bạn có muốn xóa tài khoản này không?');">Xóa</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links('vendor.pagination.bootstrap-5') }}
@endsection
