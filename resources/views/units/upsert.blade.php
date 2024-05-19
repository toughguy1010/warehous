@extends('layouts.app')
@section('content')

<form class="cs-form" action="{{ route('unit.upsert.store', ['id' => isset($unit) ? $unit->id : null]) }}" method="post">
    @csrf
    <h3 class="form-title mb-4 text-center">
        {{ isset($unit) ? "Cập nhật" : "Thêm mới" }} đơn vị
    </h3>
    <div class="mb-3">
      <label for="nameUnit" class="form-label">Tên đơn vị <span class="required">*</span></label>
      <input type="text" class="form-control" id="nameUnit" name="name" value="{{ isset($unit) ? $unit->name : "" }}" placeholder="Nhập tên đơn vị">
    </div>
    <button type="submit" class="btn btn-primary "> {{ isset($unit) ? "Cập nhật" : "Thêm " }}</button>
  </form>
@endsection