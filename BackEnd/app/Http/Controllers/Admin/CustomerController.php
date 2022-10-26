<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Customer\CustomerServiceInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    protected $customerService;

    public function __construct(CustomerServiceInterface $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index(Request $request)
    {
        $customers =  $this->customerService->all($request);
        $params = ['customers' => $customers];
        return view('admin.customers.index', $params);
    }

    public function create()
    {
    
    }

    public function store(Request $request)
    {
    
    }

    public function show($id)
    {
        $customer =  $this->customerService->find($id);
        $params = ['customer' => $customer];
        return view('admin.customers.show', $params);
    }

    public function edit($id)
    {
      
    }

    public function update(Request $request, $id)
    {
      
    }

    public function destroy($id)
    {
      
        try {
            DB::beginTransaction();
            $customer = $this->customerService->find($id);
            $customer->delete();
            DB::commit();
            $messages = 'Xóa thành công ' . $customer->name;
            Session::flash('success',$messages );
            return redirect()->route('customer.index');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('messages' . $e->getMessage() . '.Line________' . $e->getLine() . ' .File ' . $e->getFile());
            $messages = 'Xóa không thành công ' . $customer->name;
            Session::flash('error',$messages );
            return redirect()->route('customer.index');
        }
    }
    public function getTrash()
    { 
        try {
            $customers = $this->customerService->getTrash();
            $params = ['customers' => $customers];
            return view('admin.customers.recycle', $params);
        } catch (Exception $e) {
            Log::error('errors' . $e->getMessage() . 'getLine' . $e->getLine());
            abort(403);
        }
    }
    public function restore($id)
    {
        try {
            DB::beginTransaction();
            $this->customerService->restore($id);
            DB::commit();
            $messages = 'Khôi phục thành công ';
            Session::flash('success',$messages );
            return redirect()->route('customer.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('messages' . $e->getMessage() . 'line________' . $e->getLine() . 'file ' . $e->getFile());
            $messages = 'Khôi phục không thành công ';
            Session::flash('error',$messages );
            return redirect()->route('customer.index');
        }
    }
    public function forceDelete($id)
    {
        try {
            DB::beginTransaction();
            $this->customerService->forceDelete($id);
            DB::commit();
            $messages = 'Xóa thành công ';
            Session::flash('success',$messages );
            return redirect()->route('customer.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('messages' . $e->getMessage() . 'line________' . $e->getLine() . 'file ' . $e->getFile());
            $messages = 'Xóa không thành công ';
            Session::flash('error',$messages );
            return redirect()->route('customer.index');
        }
    }
    public function searchByName(Request $request)
    {
        try {
        $keyword = $request->input('keyword');
        $customers = $this->customerService->searchCustomer($keyword);
        return response()->json($customers);
        } catch (Exception $e) {
            Log::error('errors' . $e->getMessage() . 'getLine' . $e->getLine());
            abort(404);
        }

    }

    public function searchCustomer(Request $request)
    {
      
        try {
            $keySearch = $request->keySearch;
            $customers = $this->customerService->searchCustomer($keySearch);
            $params = [
                'customers' => $customers
            ];
            return  view('admin.customers.index', $params);
        } catch (Exception $e) {
            Log::error('errors' . $e->getMessage() . 'getLine' . $e->getLine());
            abort(404);
        }
    }
}