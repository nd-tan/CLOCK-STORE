<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Services\Supplier\SupplierServiceInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class SupplierController extends Controller
{
    private $supplierService;
    public function __construct(SupplierServiceInterface $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    public function index(Request $request)
    {
        $suppliers = $this->supplierService->all($request);
        return view('admin.suppliers.index',compact('suppliers'));
    }
    public function show($id){

    }

    public function create()
    {
        return view('admin.suppliers.add');
    }

    public function store(StoreSupplierRequest $request)
    {
        $data = $request->all();
        try {
            $this->supplierService->create($data);
            Session::flash('success', 'Tạo mới thành công!');
            return redirect()->route('supplier.index');
        } catch (\Exception $e) {
            Session::flash('error', 'Tạo mới không thành công!');
            Log::error('message:'. $e->getMessage());
            return redirect()->route('supplier.index');
        }
    }

    public function edit($id)
    {
        $item = $this->supplierService->find($id);
        return view('admin.suppliers.edit',compact('item'));
    }

    public function update(UpdateSupplierRequest $request,$id)
    {
        $data = $request->all();
        try {
            Session::flash('success', 'Sửa danh mục thành công!');
            $this->supplierService->update( $id, $data);
            return redirect()->route('supplier.index');
        } catch (\Exception $e) {
            Log::error('message:'. $e->getMessage());
            Session::flash('error', 'Sửa danh mục không thành công!');
            return redirect()->route('supplier.index');
        }
    }

    public function destroy($id)
    {
        try {
            $category = $this->supplierService->delete( $id);
            Session::flash('success', 'Đưa vào thùng rác thành công!');
            return redirect()->route('supplier.index');
        } catch (\Exception $e) {
            Log::error('message:'. $e->getMessage());
            Session::flash('error', 'Đưa vào thùng rác không thành công!');
            return redirect()->route('supplier.index');
        }
    }

    public function getTrashed(){
        $suppliers = $this->supplierService->getTrashed();
        return view('admin.suppliers.recycle',compact('suppliers'));
    }

    public function restore($id){
        try {
            $this->supplierService->restore($id);
            Session::flash('success', 'Khôi phục thành công!');
            return redirect()->route('supplier.getTrashed');
        } catch (\Exception $e) {
            Log::error('message:'. $e->getMessage());
            Session::flash('error', 'Khôi phục không thành công!');
            return redirect()->route('supplier.getTrashed');
        }
    }

    public function force_destroy($id){
        try {
            $category = $this->supplierService->force_destroy( $id);
            Session::flash('success', 'Xóa thành công!');
            return redirect()->route('supplier.getTrashed');
        } catch (Exception $e) {
            Log::error('message:'. $e->getMessage());
            Session::flash('error', 'Xóa không thành công!');
            return redirect()->route('supplier.getTrashed');
        }
    }
}
