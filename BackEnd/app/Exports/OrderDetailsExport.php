<?php

namespace App\Exports;

use App\Models\OrderDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithHeadings;
class OrderDetailsExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function exportOrderDetail(){

        return Excel::download(new OrderDetailsExport, 'Xuat_Don_Dat_Hang_Chi_Tiet_'.date("d_m_Y").'.xlsx');
    }
    public function headings() :array {
    	return ["STT", "Tên Khách Hàng", "Số Điện Thoại","Tên Sản Phẩm","Số Lượng", "Tổng Tiền"];
    }
    public function collection()
    {   
        return OrderDetail::join('orders','orders.id','order_details.order_id')->join('products','products.id','order_details.product_id')->select('order_details.id','orders.name_customer','orders.phone','products.name','order_details.quantity','order_details.total')->get();
    }
}
