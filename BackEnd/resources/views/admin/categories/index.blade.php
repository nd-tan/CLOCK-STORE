@extends('admin.index')
@section('content')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Danh Mục</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
          <li class="breadcrumb-item">Danh mục</a></li>
        </ol>
      </nav>
    </div>
    <a class='btn btn' style='color:rgb(52,136,245)' href="#">Thêm danh mục</a>
    <a class='btn btn' style='color:rgb(52,136,245)' href="#">Thùng rác</a>
        <form action="" id="form-search" class="form-inline d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="form-group">
                <input  class="form-control" name="key" placeholder="search by name...">
                <button  type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
    <table class="table table-bordered border-primary" style=" text-align: center; background-color: while">
        <thead>
          <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên Danh Mục</th>
            <th scope="col">Tùy Chọn</th>
          </tr>
        </thead>
        <tbody>
            {{-- @foreach ($items as $key=> $item) --}}
          <tr>
            <th scope="row">1</th>
            <td>name</td>
            <td>
                <form action="#" method="post" >
                    @method('DELETE')
                    @csrf

                    <a style='color:rgb(52,136,245)' class='btn' href="#"><i class='bi bi-pencil-square h4'></i></a>
                    <button onclick="return confirm('Bạn có chắc muốn đưa danh mục này vào thùng rác không?');" class ='btn' style='color:rgb(52,136,245)' type="submit" ><i class='bi bi-trash h4'></i></button>
                </form>
            </td>
          </tr>
        </tbody>
      </table>
</main>
@endsection
