@extends('admin.index')
@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Khách Hàng</h1>
        <nav>
            <ol class="breadcrumb">
                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Xem Khách Hàng" class="breadcrumb-item"><a href="{{ route('customer.index') }}">Khách Hàng</a></li>
                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Xem Đơn Hàng" class="breadcrumb-item"><a href="{{ route('order.index') }}">Đơn Đặt</a></li>
                <li class="breadcrumb-item">Chi Tiết Đơn Hàng</li>
            </ol>
        </nav>
    </div>
    <div class="card">
            <div class="container">
            <div class="d-flex justify-content-between align-items-center py-3">
                <h5>Mã Đơn Hàng: {{ $order->id }}</h5>
            </div>

            <!-- Main content -->
            <div class="row">
                <div class="col-lg-8">
                    <!-- Details -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3 d-flex justify-content-between">
                                <div>
                                    <span class="me-3">Ngày Đặt: {{ $order->created_at }}</span>
                                    <span class="me-3">Ngày Duyệt: {{ $order->updated_at }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <span class="me-3">Người Mua: {{ $order->name_customer }}</span>
                            </div>
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>Ảnh</td>
                                        <td>Sản phẩm</td>
                                        <td>Số Lượng</td>
                                        <td class="text-end">Giá</td>
                                        <td class="text-end">Tổng Phụ</td>
                                    </tr>
                                    @php
                                        $totalPriceOrder = 0;
                                    @endphp
                                    @foreach ($orderDetails as $orderDetail)
                                    <tr>
                                        <td>
                                                <div class="flex-shrink-0">
                                                    <img src="{{ asset($orderDetail->products->image) }}"
                                                        alt="" width="75" class="img-fluid">
                                                </div>
                                        <td>
                                            <h6 class="small mb-0">
                                                <a href="" class="text-reset">{{ $orderDetail->products->name }}</a>
                                            </h6>
                                        </td>
                                        </div>
                                        </td>
                                        <td>{{ $orderDetail->quantity }}</td>
                                        <td class="text-end">{{ number_format($orderDetail->price_at_time) }}</td>
                                        <td class="text-end">{{ number_format($orderDetail->price_at_time * $orderDetail->quantity) }}</td>
                                        @php
                                            $totalPriceOrder += $orderDetail->price_at_time * $orderDetail->quantity;    
                                        @endphp
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="fw-bold">
                                        <td colspan="4">Tổng</td>
                                        <td class="text-end">{{ number_format($totalPriceOrder)}}<span class="badge bg-success rounded-pill">VNĐ</span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- Payment -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h3 class="h6">Phương Thức Thanh Toán</h3>
                                    <p>Thanh Toán khi Nhận Hàng<br>
                                        Thanh Toán: <b>{{ number_format($totalPriceOrder) }}</b> <span class="badge bg-success rounded-pill">VNĐ</span></p>
                                </div>
                                <div class="col-lg-6">
                                    <h3 class="h6">Địa Chỉ Thanh Toán</h3>
                                    <address>
                                        <div>
                                            <strong>{{ $order->province->name }}, {{ $order->district->name }}, {{ $order->ward->name }}</strong>
                                        </div>
                                        <div>
                                            <strong>{{ $order->address }}</strong>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Customer Notes -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="h6">Yêu Cầu/Ghi Chú*</h3>
                            <p>{{ $order->note }}</p>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <!-- Shipping information -->
                        <div class="card-body">
                            <h3 class="h6">Thông Tin Vận Chuyển</h3>
                            <strong>Người Nhận:</strong>
                            <span>{{ $order->name_customer }}</span><br>
                                    <strong>Liên Hệ:</strong>
                            <span><a href="#" class="text-decoration-underline" target="_blank">{{ $order->phone }}</a> <i
                                    class="bi bi-box-arrow-up-right"></i> </span>
                            <hr>
                            <h3 class="h6">Địa Chỉ Kho</h3>
                            <address>
                                <strong>133 Lý Thường Kiệt</strong><br>
                                Thành Phố Đông Hà<br>
                                Tỉnh Quảng Trị<br>
                                <abbr title="Phone">Liên Hệ</abbr> (123) 456-7890
                            </address>
                        </div>
                    </div>
                    @if ($order->status)
                    <div class="text-center">
                        <h5>Duyệt Đơn Thành Công<i class="bi bi-check2 text-success"></i></h5>
                    </div>
                    @else 
                        <div class="mb-4">
                            <form action="{{ route('order.updatesingle', $order->id) }}" method="POST" class="mb-3">
                                @csrf
                                @method('PUT')
                                <div class="text-center">
                                    <button class="btn btn-primary">Duyệt Đơn<i class="bi bi-check2 text-success"></i></button>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <main>
@endsection