@extends('admin.index')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Danh Mục</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Danh mục</a></li>
                    <li class="breadcrumb-item active">Thêm danh mục</li>
                </ol>
            </nav>
        </div>
        <form action="{{ route('category.store') }}" method="post">
            @method('POST')
            @csrf
            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Tên danh mục</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        value="{{ old('name') }}">
                    @error('name')
                        <div class="text text-danger">{{ $message }}</div>
                    @enderror
                </div><br>
                <div class="col-sm-10">
                </div><br>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </div>
                </div>
            </div>
        </form>
    </main>
@endsection
