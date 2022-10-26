@extends('admin.home')
@section('content')

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
      <div class="md-3 title_cate">
        {{-- <a href="{{ route('customer.trash') }}" --}}
        <a href=""
            class="btn btn-danger btn-rounded waves-effect waves-light ">
            <i class=" fas fa-trash-alt"></i>
            Thùng Rác</a>
    </div>
      <table class="table table-hover">
        @if (!$customers->count())
        <tr>
            <td colspan="4">Empty List...</td>
        </tr>
    @else
        <thead>
     
          <tr>
            <th scope="col">STT</th>
            <th scope="col">Họ Và Tên</th>
            <th scope="col">Email</th>
            <th scope="col">Số Điện Thoại</th>
            <th scope="col">Ngày Đăng Ký</th>
            <th scope="col">Thao Tác</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($customers as $customer)
          <tr class="item-{{ $customer->id }}">
            <th scope="row">{{ $customer->id }}</th>
            <td><a href="">{{ $customer->name }}</td>
            <td>{{ $customer->email }}</td>
            <td>{{ $customer->phone }}</td>
            <td>{{ $customer->phone }}</td>
            <td>
                {{-- @can('Delete_Customer', 'Delete_Customer') --}}
                    {{-- <a data-url="{{ route('customer.destroy', $customer->id) }}" --}}
                        <a data-url=""
                        data-id="{{ $customer->id }}"
                        class="btn btn-danger sm deleteCustomer"><i
                            class=" fas fa-trash-alt "></i></a>
                {{-- @endcan --}}
                {{-- @can('Show_Customer', 'Show_Customer') --}}
                    {{-- <a href="{{ route('customer.show', $customer->id) }}" --}}
                        <a href=""
                        class="btn btn-primary sm ">
                        <i class="fas fa-eye"></i>
                    </a>
                {{-- @endcan --}}
            </td>
          </tr>
          @endforeach
        @endif
        </tbody>
      </table>
      <div class="row">
        <div class="col-7">
            Show {{ $customers->perPage() }} - {{ $customers->currentPage() }} of
            {{ $customers->lastPage() }}
        </div>
        <div class="col-5">
            <div class="btn-group float-end">
                {{ $customers->appends(request()->all())->links() }}
            </div>
        </div>
    </div>
    </div>
  </div>
  <script>
    $(function() {
        $('.deleteCustomer').on('click', deleteCustomer)

    })

    function deleteCustomer(event) {
        event.preventDefault();
        let url = $(this).data('url');
        let id = $(this).data('id');
        swal({
                title: "Are you sure delete?",
                text: "Once deleted,you can restore this file in recycle bin!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    jQuery.ajax({
                        type: "delete",
                        'url': url,
                        'data': {
                            id: id,
                            _token: "{{ csrf_token() }}",
                        },
                        dataType: 'json',
                        success: function(data, ) {
                            if (data.status === 1) {
                                swal("Poof! Your imaginary file has been deleted!", {
                                    icon: "success",
                                })
                                $('.item-' + id).remove()
                            }
                            if (data.status === 0) {
                                alert(data.messages)
                            }
                        }
                    });
                } else {
                    swal("Cancel the process!!");
                }
            })
    }
</script>
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
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection
