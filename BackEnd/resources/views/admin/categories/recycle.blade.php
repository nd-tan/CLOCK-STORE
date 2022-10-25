@extends('admin.index')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Danh Mục</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Danh mục</a></li>
                    <li class="breadcrumb-item">Thùng rác</a></li>
                </ol>
            </nav>
        </div>
        <a class='btn btn' style='color:rgb(52,136,245)' href="{{ route('category.index') }}">Danh sách danh mục</a>
        {{-- <form action="" id="form-search" class="form-inline d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="form-group">
                <input  class="form-control" name="key" placeholder="search by name...">
                <button  type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form> --}}
        <table class="table table-bordered border-primary" style=" text-align: center">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tên Danh Mục</th>
                    <th scope="col">Tùy Chọn</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $key => $item)
                    <tr>
                        <th scope="row">{{ ++$key }}</th>
                        <td>{{ $item->name }}</td>
                        <td>
                            <form action="{{ route('category.deleted', $item->id) }}" method="post">
                                @method('DELETE')
                                @csrf
                                {{-- <a style='color:rgb(52,136,245)' class='btn' href=""><i class='bi bi-eye h4'></i></a> --}}
                                @if (Auth::user()->hasPermission('Category_restore'))
                                    <a onclick="return confirm('Bạn có chắc muốn khôi phục danh mục này không?');"
                                        style='color:rgb(52,136,245)' class='btn'
                                        href="{{ route('category.restore', $item->id) }}"><i
                                            class='bi bi-arrow-clockwise h4'></i></a>
                                @endif
                                @if (Auth::user()->hasPermission('Category_forceDelete'))
                                    <button onclick="return confirm('Bạn có chắc muốn xóa danh mục này không?');"
                                        class='btn' style='color:rgb(52,136,245)' type="submit"><i
                                            class='bi bi-trash h4'></i></button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $items->onEachSide(5)->links() }}
    </main>
@endsection
