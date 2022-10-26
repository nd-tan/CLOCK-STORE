@extends('admin.index')
@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Nhà Cung Cấp</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item">Nhà Cung Cấp</a></li>
          </ol>
        </nav>
      </div>
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Danh Sách Nhà Cung Cấp</h5>
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
    <a class='btn btn-primary'  href="{{route('supplier.create')}}">Thêm nhà cung cấp</a>
    <a class='btn btn-secondary float-right'  href="#">Thùng rác</a>
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
          @foreach ($suppliers as $key => $supplier)
        <tr>
          <th scope="row">{{$key + 1}}</th>
          <td>{{$supplier->name}}</td>
          <td></td>
          <td>
            <form action="{{ route('supplier.destroy', $supplier->id) }}" method="post" >
                @method('DELETE')
                @csrf
            <a style='color:rgb(52,136,245)' class='btn' href="{{route('supplier.edit',$supplier->id)}}">
                <i class='bi bi-pencil-square h4'></i></a>
            <button onclick="return confirm('Bạn có chắc muốn đưa danh mục này vào thùng rác không?');" class ='btn' style='color:rgb(52,136,245)' type="submit" ><i class='bi bi-trash h4'></i></button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $suppliers->onEachSide(5)->links() }}
  </div>
</div>
</main>
@endsection
