@extends('layouts.app')
@section('content')
<div class="header-content">
    <h3>
        Danh sách tài khoản
    </h3>
    <form class="search-box">
        <input type="text" class="form-control" placeholder="Nhập tên người dùng" name="search">
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
