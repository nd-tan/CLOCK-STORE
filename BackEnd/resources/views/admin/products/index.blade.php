@extends('admin.index')
@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="mb-1">Sản Phẩm</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item">Sản Phẩm</a></li>
          </ol>
        </nav>
      </div>
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Danh Sách Sản Phẩm</h5>
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
    <a class='btn btn-primary mb-2'  href="{{route('product.create')}}">Thêm sản phẩm</a>
    <a class='btn btn-secondary mb-2 float-right'  href="{{route('product.getTrashed')}}">Thùng rác</a>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Tên</th>
          <th scope="col">Danh Mục</th>
          <th scope="col">Nhãn Hiệu</th>
          <th scope="col">Hình Ảnh</th>
          <th scope="col">Thao Tác</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($products as $key => $product)
        <tr>
          <th scope="row">{{$key + 1}}</th>
          <td><a href="">{{$product->name}}</a></td>
          <td>{{$product->category->name}}</td>
          <td>{{$product->brand->name}}</td>
          <td><img style="width:90px; height:90px" src="{{ asset('storage/images/product/' . $product->image) }}"></td>
          <td>
            <form action="{{ route('product.destroy', $product->id) }}" method="post" >
                @method('DELETE')
                @csrf
            <a style='color:rgb(52,136,245)' class='btn' href="{{route('product.edit',$product->id)}}">
                <i class='bi bi-pencil-square h4'></i></a>
            <button onclick="return confirm('Bạn có chắc muốn đưa danh mục này vào thùng rác không?');"
            class ='btn' style='color:rgb(52,136,245)' type="submit" ><i class='bi bi-trash h4'></i></button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $products->onEachSide(5)->links() }}
  </div>
</div>
</main>
@endsection
