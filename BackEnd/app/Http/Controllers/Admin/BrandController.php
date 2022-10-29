<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Services\Brand\BrandServiceInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
{
    protected $brandService;

    public function __construct(BrandServiceInterface $brandService)
    {
        $this->brandService = $brandService;
    }

    public function index(Request $request)
    {
        $brands = $this->brandService->all($request);
        return  view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.add');
    }

    public function store(StoreBrandRequest $request)
    {

        try {
            DB::beginTransaction();
            $this->brandService->create($request->all());
            Session::flash('success', config('define.store.succes'));
            DB::commit();
            return redirect()->route("brand.index");
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('errors' . $e->getMessage() . ' getLine' . $e->getLine());
            Session::flash('error', config('define.store.error'));
            return redirect()->route("brand.index");
        }
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $brand = $this->brandService->find($id);
        return view('admin.brands.edit',compact('brand'));
    }

    public function update($id, UpdateBrandRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->brandService->update($id, $request->all());
            Session::flash('success', config('define.update.succes'));
            DB::commit();
            return redirect()->route("brand.index");
        } catch (Exception $e) {
            Db::rollBack();
            Log::error('errors' . $e->getMessage() . ' getLine' . $e->getLine());
            Session::flash('error', config('define.update.error'));
            return redirect()->route("brand.index");
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $brand = $this->brandService->delete($id);
            Session::flash('success', config('define.recycle.succes'));
            DB::commit();
            return redirect()->route("brand.index");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('messages' . $e->getMessage() . 'line________' . $e->getLine() . 'file ' . $e->getFile());
            Session::flash('error', config('define.recycle.error'));
            return redirect()->route("brand.index");
        }
    }

    public function getTrashed(Request $request)
    {
        $brands = $this->brandService->getTrash($request);
        return view('admin.brands.recycle',compact('brands'));
    }

    public function restore($id)
    {
        try {
            DB::beginTransaction();
            $this->brandService->restore($id);
            Session::flash('success', config('define.restore.succes'));
            DB::commit();
            return redirect()->route("brand.getTrashed");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('messages' . $e->getMessage() . 'line________' . $e->getLine() . 'file ' . $e->getFile());
            Session::flash('error', config('define.restore.error'));
            return redirect()->route("brand.getTrashed");
        }
    }

    public function force_destroy(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->id;
            $this->brandService->forceDelete($id);
            DB::commit();
            Session::flash('success', config('define.delete.succes'));
            return redirect()->route("brand.getTrashed");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('messages' . $e->getMessage() . 'line________' . $e->getLine() . 'file ' . $e->getFile());
            Session::flash('error', config('define.delete.error'));
            return redirect()->route("brand.getTrashed");
        }
    }

}
