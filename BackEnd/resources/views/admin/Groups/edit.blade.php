@extends('admin.index')
@section('content')
  <main id="main" class="main">
    <div class="pagetitle">
        <h1 class="mb-1">Nhân viên</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{route('groups.index')}}">Nhân viên</a></li>
            <li class="breadcrumb-item"> Sửa nhân viên</a></li>
          </ol>
        </nav>
      </div>
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Sửa chức vụ</h5>
    <form action="{{ route('groups.update', $item->id) }}" method="post">
        @method('PUT')
        @csrf
      <div class="col-md-10">
        <label for="inputName5" class="form-label">Tên chức vụ</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror"
        id="inputName5" name='name' value="{{ old('name') ?? $item->name }}">
        @error('name')
        <div class="text text-danger">{{ $message }}</div>
        @enderror
        <br>
        <button type="submit" class="btn btn-primary">Sửa</button>
        <button type="reset" class="btn btn-secondary">Hủy</button>
      </div>
    </form>
  </div>
</div>
</div>
</main>
  @endsection
