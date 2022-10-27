@extends('admin.index')
@section('content')
  <main id="main" class="main">
    <div class="pagetitle">
        <h1 class="mb-1">Sản Phẩm</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{route('product.index')}}">Sản Phẩm</a></li>
            <li class="breadcrumb-item"> Thêm Sản Phẩm</a></li>
          </ol>
        </nav>
      </div>
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Thêm Sản Phẩm</h5>
    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-md-11">
            <label for="inputName5" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" id="inputName5" name="name"><br>

          <div class="row g-3">
            <div class="col-md-4">
                <label for="inputState" class="form-label">Nhãn hiệu</label>
                <select id="inputState" class="form-select" name="brand_id">
                    <option selected>-----Nhãn hiệu-----</option>
                    @foreach($brands as $brand)
                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                    @endforeach
                </select>
              </div>
              <div class="col-md-4">
                <label for="inputState" class="form-label">Danh mục</label>
                <select id="inputState" class="form-select" name="category_id">
                    <option selected>-----Danh mục-----</option>
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
              </div>
              <div class="col-md-4">
                <label for="inputState" class="form-label">Nhà cung cấp</label>
                <select id="inputState" class="form-select" name="supplier_id">
                    <option selected>-----Nhà cung cấp-----</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                    @endforeach
                </select>
              </div>

          <div class="col-md-6">
            <label for="inputEmail5" class="form-label">Giá</label>
            <input type="number" class="form-control" id="inputEmail5" name="price">
          </div>
          <div class="col-md-6">
            <label for="inputPassword5" class="form-label">Số Lượng</label>
            <input type="number" class="form-control" id="inputPassword5" name="quantity">
          </div>
          <div class="col-12">
            <label for="inputAddress2" class="form-label">Mô Tả</label>
            <textarea name="description" class="form-control" value="{{ old('description') }}" id="ckeditor1" rows="4"
            style="resize: none"></textarea>
          </div>
          <div class="col-md-4">
            <label for="inputCity" class="form-label">Ảnh</label>
            <input accept="image/*" type='file' id="inputFile" name="inputFile" class="form-control @error('inputFile') is-invalid @enderror">
        @error('inputFile')
        <div class="text text-danger">{{ $message }}</div>
        @enderror
        <br>
        <img type="hidden" width="120px" height="120px" id="blah" src="" alt="" />
          </div>
          <div class="col-md-8">
            <label for="file_name" class="form-label">Ảnh Chi Tiết</label>
            <div class="card_file_name">
                <div class="form-group form_input @error('file_names') border border-danger @enderror">
                    <span class="inner"><span class="select"></span>
                    </span>
                    <input type="file" name="file_names[]" id="file_name" multiple
                        class="form-control files @error('file_name') is-invalid @enderror">
                </div>
                <div class="container_image">
                    @error('file_names')
                        <div class="text text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
          </div>

          <div class="col-12">
            <button type="submit" class="btn btn-primary">Thêm</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
          </div>

    </form>
  </div>
</div>
</div>
<script src="{{ asset('AdminTheme/ckeditor/ckeditor.js') }}"></script> <!-- END THEME JS -->
<script>
    CKEDITOR.replace('ckeditor');
    CKEDITOR.replace('ckeditor1');
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  jQuery(document).ready(function() {
    if( $('#blah').hide()){
      $('#blah').hide();
    }
      jQuery('#inputFile').change(function() {
          $('#blah').show();
          const file = jQuery(this)[0].files;
          if (file[0]) {
              jQuery('#blah').attr('src', URL.createObjectURL(file[0]));
              jQuery('#blah1').attr('src', URL.createObjectURL(file[0]));
          }
      });
  });
</script>
</main>
  @endsection
