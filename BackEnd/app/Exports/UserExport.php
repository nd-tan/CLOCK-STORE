<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;

class UserExport implements FromCollection,WithHeadings
{
    public function collection()
    {
        return User::select('id','name','address','email','phone','birthday','gender','province_id','district_id','ward_id','group_id','created_at','updated_at')->get();
    }
    public function headings() :array {
    	return ["STT", "Tên nhân viên", "Địa chỉ","E-mail","Số điện thoại","Ngày sinh","Giới tính","Tỉnh/Thành phố","Huyện/Thị xã","Phường/Xã","Chức vụ","Ngày in","Ngày xuất"];
    }
    public function exportUser(){
        return Excel::download(new UserExport, 'Nhan_vien'.date("d_m_Y").'.xlsx');
    }
}
