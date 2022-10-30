@extends('admin.index')
@section('content')
  <main id="main" class="main">
    <div class="pagetitle">
        <h1 class="mb-1">Sản Phẩm</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{route('product.index')}}">Sản Phẩm</a></li>
            <li class="breadcrumb-item"> Chi Tiết Sản Phẩm</a></li>
          </ol>
        </nav>
      </div>
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Chi Tiết Sản Phẩm</h5><br>



<div class="row g-0">
    <div class="col-md-6">
        <div class="d-flex flex-column justify-content-center">
            <div class="main_image"> <img src="{{ asset('storage/images/product/' .$product->image) }}" id="main_product_image" height="300" width="412">
            </div><br>
            <div class="thumbnail_images">
                <ul style="padding-left: 0rem;" id="thumbnail">
                    <img onclick="changeImage(this)" src="{{ asset('storage/images/product/' .$product->image) }}" width="100">
                    @foreach ($product->product_images as $file_name)
                        <img onclick="changeImage(this)" src="{{ asset('storage/images/product/' .$file_name->image) }}"
                            width="100px">
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="p-3 right-side">
            <div class="mt-2"> <span class="fw-bold">Thông tin chi tiết:</span><br><br>
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>Tên sản phẩm</td>
                            <td>{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <td>Trạng thái</td>
                            <td>{{ $product->status == 0 ? 'Ẩn' : 'Hiện' }}</td>
                        </tr>
                        <tr>
                            <td>Nhà cung cấp</td>
                            <td>{{ $product->supplier->name }}</td>
                        </tr>
                        <tr>
                            <td>Danh mục</td>
                            <td>{{ $product->category->name }}</td>
                        </tr>
                        <tr>
                            <td>Thương hiệu</td>
                            <td>{{ $product->brand->name }}</td>
                        </tr>
                        <tr>
                            <td>Loại</td>
                            <td>{{ $product->type_gender }}</td>
                        </tr>
                        <tr>
                            <td>Số lượng</td>
                            <td>{{ $product->quantity}} Chiếc</td>
                        </tr>
                        <tr>
                            <td>Giá bán</td>
                            <td>{{ number_format($product->price)}} Đồng</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="product-info-tabs">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab"
                    aria-controls="description" aria-selected="true">Mô tả</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab"
                    aria-controls="review" aria-selected="false">Nhân viên thêm</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab"
                    aria-controls="review" aria-selected="false">Nhân viên sửa</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="description" role="tabpanel"
                aria-labelledby="description-tab">
                {!! $product->description !!}
            </div>
            {{-- <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                <div class="review-heading">REVIEWS</div>
                <p class="mb-20">There are no reviews yet.</p>
                <div class="form-group">
                    <label>Your rating</label>
                    <div class="reviews-counter">
                        <div class="rate">
                            <input type="radio" id="star5" name="rate" value="5" />
                            <label for="star5" title="text">5 stars</label>
                            <input type="radio" id="star4" name="rate" value="4" />
                            <label for="star4" title="text">4 stars</label>
                            <input type="radio" id="star3" name="rate" value="3" />
                            <label for="star3" title="text">3 stars</label>
                            <input type="radio" id="star2" name="rate" value="2" />
                            <label for="star2" title="text">2 stars</label>
                            <input type="radio" id="star1" name="rate" value="1" />
                            <label for="star1" title="text">1 star</label>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

</div>

</div>
</div>
</div>
</main>
@endsection
