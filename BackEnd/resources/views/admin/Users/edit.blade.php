@extends('admin.index')
@section('content')
  <main id="main" class="main">
    <div class="pagetitle">
        <h1 class="mb-1">Nhân viên</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{route('users.index')}}">Nhân viên</a></li>
            <li class="breadcrumb-item"> Sửa nhân viên</a></li>
          </ol>
        </nav>
      </div>
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Sửa nhân viên</h5>
    <form action="{{ route('users.update', $users->id) }}" method="post">
        @method('PUT')
        @csrf
      <div class="col-md-10">
      <div class="row g-3">
      <div class="col-md-12">
        <label for="inputEmail5" class="form-label">Ảnh đại diện</label>
        <input type="file" class="form-control @error('image') is-invalid @enderror"
        name='image' id="inputName5" value="{{ old('image') ?? $users->image }}">
        @error('image')
        <div class="text text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-md-12">
        <label for="inputPassword5" class="form-label">Tên nhân viên</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror"
         name='name' id="inputName5" value="{{ old('name') ?? $users->name }}">
        @error('name')
        <div class="text text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-md-12">
        <label for="inputPassword5" class="form-label">Địa chỉ</label>
        <input type="text" class="form-control @error('address') is-invalid @enderror"
         name='address' id="inputName5" value="{{ old('address') ?? $users->address }}">
        @error('address')
        <div class="text text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-md-12">
        <label for="inputPassword5" class="form-label">E-mail</label>
        <input type="text" class="form-control @error('email') is-invalid @enderror"
         name='email' id="inputName5" value="{{ old('email') ?? $users->email }}">
        @error('email')
        <div class="text text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-md-12">
        <label for="inputPassword5" class="form-label">Số điện thoại</label>
        <input type="text" class="form-control @error('phone') is-invalid @enderror"
         name='phone' id="inputName5" value="{{ old('phone') ?? $users->phone }}">
        @error('phone')
        <div class="text text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-md-12">
        <label for="inputPassword5" class="form-label">Ngày Sinh</label>
        <input type="date" class="form-control @error('birthday') is-invalid @enderror"
         name='birthday' id="inputName5" value="{{ old('birthday') ?? $users->birthday }}">
        @error('birthday')
        <div class="text text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-3">
        <label>Giới tính</label><br/>
        <br/>
        <label class="form-radio-label">
            <input class="form-radio-input" type="radio" name="gender" value="Nam"
                   checked="Nam">
            <span class="form-radio-sign">Nam</span>
        </label>
        <label class="form-radio-label ml-3">
            <input class="form-radio-input" type="radio" name="gender" value="Nữ">
            <span class="form-radio-sign">Nữ</span>
        </label>
    </div>
      </div><br>
        <button type="submit" class="btn btn-primary">Sửa</button>
        <button type="reset" class="btn btn-secondary">Hủy</button>
      </div>
    </form>
  </div>
</div>
</div>
</main>
  @endsection
