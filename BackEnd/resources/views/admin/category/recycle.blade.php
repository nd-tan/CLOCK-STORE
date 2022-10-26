@extends('admin.index')
@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Danh Mục</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{route('category.index')}}">Danh mục</a></li>
            <li class="breadcrumb-item">Thùng Rác</li>
          </ol>
        </nav>
      </div>
<div class="card">
  <div class="card-body">
      <h5 class="card-title">Thùng Rác</h5>
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
    <a class='btn btn-primary'  href="{{route('category.index')}}">Danh sách danh mục</a>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">The number of products</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($categories as $key => $category)
        <tr>
          <th scope="row">{{$key + 1}}</th>
          <td>{{$category->name}}</td>
          <td>{{$category->products->count()}}</td>
          <td>
            <form action="{{ route('category.delete', $category->id) }}" method="post" >
                @method('DELETE')
                @csrf
                <a onclick="return confirm('Bạn có chắc muốn khôi phục danh mục này không?');"
                    style='color:rgb(52,136,245)' class='btn'
                    href="{{ route('category.restore', $category->id) }}"><i
                    class='bi bi-arrow-clockwise h4'></i></a>
                <button onclick="return confirm('Bạn có chắc muốn xóa danh mục này không?');"
                    class ='btn' style='color:rgb(52,136,245)' type="submit" ><i class='bi bi-trash h4'></i></button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
</main>
@endsection
