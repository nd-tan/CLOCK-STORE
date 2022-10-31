@extends('admin.home')
@section('content')
    <main  id="main" class="main">
 
    <div class="pagetitle">
        <h1>Khách Hàng</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a data-bs-toggle="tooltip" data-bs-placement="top" title="Danh Sách Khách Hàng" href="{{ route('customer.index') }}">Khách Hàng</a></li>
                <li class="breadcrumb-item"><a data-bs-toggle="tooltip" data-bs-placement="top" title="Danh Sách Đặt Hàng" href="{{ route('order.index') }}">Đặt Hàng</a></li>
            </ol>
        </nav>
    </div>
    <section  class="section profile">
        <div class="container col-xl-6">
        <div class="row">
        <div class="card card-body pt-10">
                    <button data-bs-toggle="tooltip" data-bs-placement="top" title="Thông Tin Khách Hàng" class="btn">Thông Tin</button>
                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                        <h5 class="card-title">Hồ Sơ</h5>
                        <div class="row">
                            <div class="col-md-4 label">Họ Và Tên:</div>
                            <div data-bs-toggle="tooltip" data-bs-placement="top" title="Tên Khách Hàng" class="col-md-4 label">{{ $customer->name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 label">Số Điên Thoại:</div>
                            <div data-bs-toggle="tooltip" data-bs-placement="top" title="Số Điện Thoại Khách Hàng" class="col-md-4 label">{{ $customer->phone }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 label">Email:</div>
                            <div data-bs-toggle="tooltip" data-bs-placement="top" title="Email Khách Hàng" class="col-md-4 label">{{ $customer->email }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 label">Ngày Đăng Ký:</div>
                            <div class="col-md-4 label">{{ $customer->created_at }}</div>
                        </div>
                </div>
            </div>
                </section>
            </main>
 @endsection
