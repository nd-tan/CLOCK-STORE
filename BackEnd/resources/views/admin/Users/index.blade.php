@extends('admin.index')
@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="mb-1">Nhân viên</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item">Nhân viên</a></li>
          </ol>
        </nav>
      </div>
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Danh sách nhân viên</h5>
    @if (Session::has('success'))
    <p class="text-success"><i class="fa fa-check" aria-hidden="true"></i>
        {{ Session::get('success') }}
    </p>
@endif
@if (Session::has('error'))
    <p class="text-danger"><i class="bi bi-x-circle"></i>
        {{ Session::get('error') }}
    </p>
@endif
@if(Auth::user()->hasPermission('User_create'))
    <a class='btn btn-primary mb-2'  href="{{route('users.create')}}">Thêm nhân viên</a>
@endif
    <a class='btn btn-secondary mb-2 float-right'  href="{{route('user.getTrashed')}}">Thùng rác</a>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">Mã Nhân Viên</th>
          <th scope="col">Ảnh Đại Diện</th>
          <th scope="col">Tên Nhân Viên</th>
          <th scope="col">Địa Chỉ</th>
          <th scope="col">Số Điện Thoại</th>
          {{-- <th scope="col">Tỉnh</th>
          <th scope="col">Quận</th>
          <th scope="col">Xã</th> --}}
          <th scope="col">Nhóm Nhân Viên</th>
          <th scope="col">Tùy chọn</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($users as $key => $user)
        <tr>
          <th scope="row">{{$key + 1}}</th>
          <td>{{$user->image}}</td>
          <td>{{$user->name}}</td>
          <td>{{$user->address}}</td>
          <td>{{$user->phone}}</td>
          {{-- <td>{{$user->province_id->name}}</td> --}}
          {{-- <td>{{$user->district_id->name}}</td>
          <td>{{$user->ward_id->name}}</td> --}}
          <td>{{$user->group_id}}</td>
          <td>
            <form action="{{ route('user.delete', $user->id) }}" method="post" >
                @method('DELETE')
                @csrf
                @if(Auth::user()->hasPermission('User_update'))
            <a style='color:rgb(52,136,245)' class='btn' href="{{route('users.edit',$user->id)}}">
                <i class='bi bi-pencil-square h4'></i></a>
                @endif
                @if(Auth::user()->hasPermission('User_delete'))
            <button onclick="return confirm('Bạn có chắc muốn đưa danh mục này vào thùng rác không?');"
            class ='btn' style='color:rgb(52,136,245)' type="submit" ><i class='bi bi-trash h4'></i></button>
                @endif
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $users->onEachSide(3)->links() }}
  </div>
</div>
</main>
@endsection
