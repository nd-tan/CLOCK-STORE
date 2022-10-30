@extends('admin.index')
@section('content')
  <main id="main" class="main">
    <div class="pagetitle">
        <h1 class="mb-1">Nhân Viên</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{route('users.index')}}">Nhân viên</a></li>
            <li class="breadcrumb-item"> Thêm nhân viên</a></li>
          </ol>
        </nav>
      </div>
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Thêm nhân viên</h5>
    <form action="{{ route('users.store') }}" method="post">
        @csrf
      <div class="col-md-10">
        <label for="inputName5" class="form-label">Tên nhân viên</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputName5" name='name' value="{{ old('name') }}">
        @error('name')
        <div class="text text-danger">{{ $message }}</div>
        @enderror

      <div class="row g-3">
      <div class="col-md-12">
        <label for="inputEmail5" class="form-label">Hình ảnh nhân viên</label>
        <input type="file" class="form-control @error('image') is-invalid @enderror" name='image' id="inputName5" value="{{ old('image') }}">
        @error('image')
        <div class="text text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-md-12">
        <label for="inputEmail5" class="form-label">Địa chỉ</label>
        <input type="text" class="form-control @error('address') is-invalid @enderror" name='address' id="inputName5" value="{{ old('address') }}">
        @error('address')
        <div class="text text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-md-12">
        <label for="inputPassword5" class="form-label">E-mail</label>
        <input type="text" class="form-control @error('email') is-invalid @enderror" name='email' id="inputName5" value="{{ old('email') }}">
        @error('email')
        <div class="text text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-md-12">
        <label for="inputPassword5" class="form-label">Số điện thoại</label>
        <input type="text" class="form-control @error('phone') is-invalid @enderror" name='phone' id="inputName5" value="{{ old('phone') }}">
        @error('phone')
        <div class="text text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-md-12">
        <label for="inputPassword5" class="form-label">Mật khẩu</label>
        <input type="text" class="form-control @error('password') is-invalid @enderror" name='password' id="inputName5" value="{{ old('password') }}">
        @error('password')
        <div class="text text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-md-12">
        <label for="inputPassword5" class="form-label">Ngày sinh</label>
        <input type="date" class="form-control @error('birthday') is-invalid @enderror" name='birthday' id="inputName5" value="{{ old('birthday') }}">
        @error('birthday')
        <div class="text text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Tỉnh</label>
                <select name="province_id" id="province_id" class="form-control province_id"
                aria-label="Default select example" data-toggle="select2">
                <option selected="" value="">Vui lòng chọn</option>
                @foreach ($provinces as $province)
                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                @endforeach
            </select>
            </div>
        </div>
        <div class="col-md-12">
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Thành Phố/Huyện</label>
                    <select name="district_id" id="district_id" class="form-control district_id"
                    aria-label="Default select example" data-toggle="select2">
                    <option selected="" value="">Vui lòng chọn</option>
                    @foreach ($districts as $district)
                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                    @endforeach
                </select>
                </div>
            </div>
            <div class="col-md-12">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phường/Xã</label>
                        <select name="ward_id" id="ward_id" class="form-control ward_id"
                        aria-label="Default select example" data-toggle="select2">
                        <option selected="" value="">Vui lòng chọn</option>
                        @foreach ($wards as $ward)
                            <option value="{{ $ward->id }}">{{ $ward->name }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
      <div class="row form-group">
        <div class="col-6">
            <label for="exampleFormControlSelect1">Nhóm nhân viên</label>
            <select class="form-control" name="group_id"
                    id="exampleFormControlSelect1">
                @foreach($groups as $group)
                    <option
                        value="{{$group->id}}" @selected(old('floor')==$group->id)>{{$group->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
      <div class="col-3">
        <label>Giới tính</label><br/>
        <br/>
        <label class="form-radio-label">
            <input class="form-radio-input" type="radio" name="gender" value="Nam"
                   checked="Nam">
            <span class="form-radio-sign">Nam</span>
        </label>
        <label class="form-radio-label ml-3">
            <input class="form-radio-input" type="radio" name="gender" value="Nữ">
            <span class="form-radio-sign">Nữ</span>
        </label>
    </div>
      </div><br>
        <button type="submit" class="btn btn-primary">Thêm</button>
        <button type="reset" class="btn btn-secondary">Hủy</button>
      </div>
    </form>
  </div>
</div>
</div>
</main>
<script type="text/javascript">
    $(function() {
        $(document).on('change', '.province_id', function() {
            var province_id = $(this).val();
            var district_name = $('.district_id').find('option:selected').text();
            console.log(district_name);
            console.log(province_id);
            if (province_id == '') {
                $('#province_id').notify("Lỗi:Địa chỉ không được để trống", {
                    globalPosition: 'top left',
                });
                return false;
            }
            $.ajax({
                url: "{{ route('user.GetDistricts') }}",
                type: "GET",
                data: {
                    province_id: province_id
                },
                success: function(data) {
                    console.log(data);
                    var html = '<option value="">Vui lòng chọn</option>';
                    $.each(data, function(key, v) {
                        console.log(v);
                        html += '<option value=" ' + v.province_id + ' "> ' + v
                            .name + '</option>';
                    });
                    $('.district_id').html(html);
                }
            })
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        $(document).on('change', '#district_id, .payment', function() {
            var district_id = $(this).val();
            var ward_id = $(this).val();
            var ward_name = $('.ward_id').find('option:selected').text();
            if (district_id == '') {
                $('#district_id').notify("Lỗi:Địa chỉ không được để trống", {
                    globalPosition: 'top left',
                });
                return false;
            }
            if (ward_id == '') {
                $('#ward_id').notify("Lỗi:Địa chỉ không được để trống", {
                    globalPosition: 'top left',
                });
                return false;
            }
            $.ajax({
                url: "{{ route('user.getWards') }}",
                type: "GET",
                data: {
                    district_id: district_id
                },
                success: function(data) {
                    console.log(data);
                    var html = '<option value="">Vui lòng chọn</option>';
                    $.each(data, function(key, v) {
                        html += '<option value =" ' + v.id + ' "> ' + v.name +
                            '</option>';
                    });
                    $('#ward_id').html(html);
                }
            })
        });
    });
</script>
  @endsection
