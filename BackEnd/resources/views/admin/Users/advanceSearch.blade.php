<div class="modal fade" id="searchModal" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <form method="get">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tìm kiếm nâng cao</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label" for="nameVi">Danh sách nhân viên</label>
                                <select class=" form-select" name="users" id="users" style="width: 470px">
                                    <option style="text-align: center" value="">Nhân viên</option>
                                    @foreach ($users as $user)
                                        <option value="{{  $user->id }}">{{ $user->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label" for="nameVi">Địa chỉ</label>
                                <select class=" form-select" name="users" id="users" style="width: 470px">
                                    <option style="text-align: center" value="">Địa chỉ</option>
                                    @foreach ($users as $user)
                                        <option value="{{  $user->address }}"></option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <p><b>Giới tính</b></p>
                                <input type="radio" name="type_gender" value="Nam">
                                <label for="html">Nam </label>&nbsp&nbsp&nbsp
                                <input type="radio" name="type_gender" value="Nữ">
                                <label for="css">Nữ</label><br>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </div>
            </div>
        </form>

    </div>
</div>
