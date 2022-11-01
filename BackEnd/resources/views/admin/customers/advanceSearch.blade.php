{{-- selec2 cdn --}}

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
                       
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <label class="form-label" for="quantity">Tên Khách Hàng
                                </label>
                                <input type="text" name="name" value="{{ request()->name }}" placeholder="Tên Khách Hàng" class="form-control" >
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="name">Số Điện Thoại</span>
                                </label>
                                <input type="text"  class="form-control"
                                    name="phone" value="{{ request()->phone }}" id="phone" placeholder="Số Điện Thoại">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <label class="form-label" for="name">Email</label>
                                <input type="text" value="{{ request()->email }}"  class="form-control" name="email"
                                    id="email" placeholder="Email">
                            </div>
                        </div>
                    
                    
                    </div>

                </div>
                <div class="modal-footer">
                    <a href="{{ route('customer.index') }}" class="btn btn-warning">Đặt Lại</a>
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </div>
            </div>
        </form>

    </div>
</div>