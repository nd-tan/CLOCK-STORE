@extends('admin.index')
@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Khách Hàng</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a data-bs-toggle="tooltip" data-bs-placement="top" title="Xem Khách Hàng" href="{{ route('customer.index') }}">Khách Hàng</a></li>
                <li class="breadcrumb-item">Đơn Đặt</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Danh Sách Đơn Hàng</h5>
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
            <table style="text-align: center" class="table table-hover">
                @if (!$orders->count())
                    <tr>
                        <td colspan="6">Danh Sách Rỗng!</td>
                    </tr>
                @else
                <div class="md-3 title_cate d-flex">
                    <div class="form-outline">
                        <form action="">
                            <input type="search" value="{{ request()->search }}" name="search"
                                id="form1" class="form-control" />
                    </div>
                    <button type="submit" class="btn btn-primary  waves-effect waves-light ">
                        Tìm
                    </button>
                    </form>
                </div>
            </div>
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Họ Và Tên</th>
                            <th scope="col">Số Điện Thoại</th>
                            <th scope="col">Trạng Thái Đơn Hàng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                                    <td>{{ $order->id }}</td>
                                    <td><a  data-bs-toggle="tooltip" data-bs-placement="top" title="Chi Tiết Đơn Hàng" href="{{ route('order.show',$order->id) }}">{{ $order->name_customer }}</a></td>
                                    <td>{{ $order->phone }}</td>
                                    <td>
                                    @if($order->status)
                                        <i data-bs-toggle="tooltip" data-bs-placement="top" title="Đã Duyệt" class="bi bi-check-circle text-success"></i>
                                    @else
                                        <i data-bs-toggle="tooltip" data-bs-placement="top" title="Chờ Duyệt" class="bi bi-x-circle text-danger"></i>
                                    @endif
                                    </td>
                                    
                            </tr>
                        @endforeach
                @endif
                </tbody>
            </table>
                {{ $orders->onEachSide(5)->links() }}
        </div>
    </div>
</div>
    <main>
@endsection