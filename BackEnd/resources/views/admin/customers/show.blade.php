@extends('admin.home')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Khách Hàng</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="">Order</a></li>
                </ol>
            </nav>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Chi Tiết Khách Hàng</h5>
                <div class="md-3 title_cate" >
                    <a href="{{ route('customer.index') }}" class="btn btn-info btn-rounded waves-effect waves-light ">
                        <i class=" fas fa-trash-alt"></i>
                        Khách Hàng</a>
                </div>
                <table style="text-align: center" class="table table-hover">
                        <thead>

                            <tr>
                                <th scope="col">Họ Và Tên</th>
                                <th scope="col">Email</th>
                                <th scope="col">Số Điện Thoại</th>
                                <th scope="col">Ngày Đăng Ký</th>
                                <th scope="col">Ngày Xóa</th>
                                <th scope="col">Ngày Cập Nhật</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ $customer->created_at }}</td>
                                    <td>{{ $customer->deleted_at }}</td>
                                    <td>{{ $customer->updated_at }}</td>
                                </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
 @endsection
