@extends('admin.index')
@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="mb-1">Thùng rác</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('users.index')}}"></a>Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="">Nhân viên</a></li>
            <li class="breadcrumb-item">Thùng rác</a></li>
          </ol>
        </nav>
      </div>
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Thùng rác</h5>
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
    <a class='btn btn-primary mb-2'  href="{{route('users.index')}}">Nhân viên</a>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Tên</th>
          <th scope="col">Email</th>
          <th scope="col">Địa Chỉ</th>
          <th scope="col">Số Điện Thoại</th>
          <th scope="col">Thao tác</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($users as $key => $user)
        <tr>
          <th scope="row">{{$key + 1}}</th>
          <td>{{$user->name}}</td>
          <td>{{$user->email}}</td>
          <td>{{$user->address}}</td>
          <td>{{$user->phone}}</td>
          <td>
            <form action="{{ route('users.delete', $user->id) }}" method="post" >
                @method('DELETE')
                @csrf
                <a onclick="return confirm('Bạn có chắc muốn khôi phục nhà cung cấp này không?');"
                style='color:rgb(52,136,245)' class='btn'
                href="{{ route('users.restore', $user->id) }}"><i
                class='bi bi-arrow-clockwise h4'></i></a>
            <button onclick="return confirm('Bạn có chắc muốn xóa danh mục này không?');"
            class ='btn' style='color:rgb(52,136,245)' type="submit" ><i class='bi bi-trash h4'></i></button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{-- {{ $users->onEachSide(5)->links() }} --}}
  </div>
</div>
</main>
@endsection
