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
                <h5 class="card-title">Danh Sách Khách Hàng</h5>
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
                <div style="text-align: right" class="md-3 title_cate" >
                    <a href="{{ route('customer.trash') }}" class="btn btn-danger btn-rounded waves-effect waves-light ">
                        <i class=" fas fa-trash-alt"></i>
                        Thùng Rác</a>
                </div>
                <table style="text-align: center" class="table table-hover">
                    @if (!$customers->count())
                        <tr>
                            <td colspan="6">Danh Sách Rỗng!</td>
                        </tr>
                    @else
                        <thead>

                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Họ Và Tên</th>
                                <th scope="col">Email</th>
                                <th scope="col">Số Điện Thoại</th>
                                <th scope="col">Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr class="item-{{ $customer->id }}">
                                    <th scope="row">{{ $customer->id }}</th>
                                    <td><a href="{{ route('customer.show',$customer->id) }}">{{ $customer->name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>
                                        <form action="{{ route('customer.destroy',$customer->id) }}" method="post" >
                                            @method('DELETE')
                                            @csrf
                                            <button onclick=" return confirm('Bạn có chắc xóa khách hàng '.$customer->name);" class ='btn' style='color:rgb(52,136,245)' type="submit" ><i class='bi bi-trash h4'></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                    @endif
                    </tbody>
                </table>
                    {{ $customers->onEachSide(5)->links() }}
            </div>
        </div>
    </div>
        <main>
            <script>
                $(function() {
                    $('.deleteCustomer').on('click', deleteCustomer)

                })
            <script>
                $(function() {
                    $("#keyword").autocomplete({
                        serviceUrl: 'searchCustomers',
                        paramName: "keyword",
                        onSelect: function(suggestion) {
                            console.log(suggestion);
                            $("#keyword").val(suggestion.value);
                        },
                        transformResult: function(response) {
                            return {
                                suggestions: $.map($.parseJSON(response), function(item) {
                                    console.log(item);
                                    return {
                                        value: item.name,
                                    };
                                })
                            };
                        },

                    });
                })
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 @endsection
