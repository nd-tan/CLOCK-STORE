<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Services\Product\ProductServiceInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductServiceInterface $productService){
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $products = $this->productService->all($request);
        $categories = Category::get();
        $brands = Brand::get();
        $suppliers = Supplier::get();
        $params = [
            'categories' => $categories,
            'brands' => $brands,
            'suppliers' => $suppliers,
            'products' => $products
        ];
        return view('admin.products.index', $params);
    }

    public function create()
    {
        $categories = Category::get();
        $brands = Brand::get();
        $suppliers = Supplier::get();
        $params = [
            'categories' => $categories,
            'brands' => $brands,
            'suppliers' => $suppliers
        ];
        return view('admin.products.add', $params);
    }

    public function store(StoreProductRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->productService->create($request);
            Session::flash('success', config('define.store.succes'));
            DB::commit();
            return redirect()->route('product.index');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('errors' . $e->getMessage() . ' getLine' . $e->getLine());
            Session::flash('error', config('define.store.error'));
            return redirect()->route('product.index');
        }
    }

    public function show( $id)
    {
        $product = $this->productService->find($id);
        return view('admin.products.detail',compact('product'));
    }

    public function edit($id)
    {
        $product = $this->productService->find($id);
        $categories = Category::get();
        $brands = Brand::get();
        $suppliers = Supplier::get();
        $params = [
            'categories' => $categories,
            'brands' => $brands,
            'product' => $product,
            'suppliers' => $suppliers,
        ];

        return view('admin.products.edit', $params);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $this->productService->update($id, $data);
            Session::flash('success', config('define.update.succes'));
            DB::commit();
            return redirect()->route('product.index');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('errors' . $e->getMessage() . ' getLine' . $e->getLine());
            Session::flash('error', config('define.update.error'));
            return redirect()->route('product.index');
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $this->productService->delete($id);
            Session::flash('success', config('define.recycle.succes'));
            DB::commit();
            return redirect()->route('product.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('errors' . $e->getMessage() . ' getLine' . $e->getLine());
            Session::flash('error', config('define.recycle.error'));
            return redirect()->route('product.index');
        }
    }
    public function getTrashed(Request $request)
    {
        $products = $this->productService->getTrashed($request);
        $categories = Category::get();
        $brands = Brand::get();
        $suppliers = Supplier::get();
        $params = [
            'categories' => $categories,
            'brands' => $brands,
            'suppliers' => $suppliers,
            'products' => $products
        ];
        return view('admin.products.recycle', $params);
    }
    public function restore($id)
    {
        try {
            DB::beginTransaction();
            $this->productService->restore($id);
            Session::flash('success', config('define.restore.succes'));
            DB::commit();
            return redirect()->route('product.getTrashed');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('errors' . $e->getMessage() . ' getLine' . $e->getLine());
            Session::flash('error', config('define.restore.error'));
            return redirect()->route('product.getTrashed');
        }
    }
    public function force_destroy($id)
    {
        try {
            DB::beginTransaction();
            $this->productService->force_destroy($id);
            Session::flash('success', config('define.delete.succes'));
            DB::commit();
            return redirect()->route('product.getTrashed');
        }catch (Exception $e) {
            DB::rollBack();
            Log::error('errors' . $e->getMessage() . ' getLine' . $e->getLine());
            Session::flash('error', config('define.delete.error'));
            return redirect()->route('product.getTrashed');
        }
    }
    public function showStatus($id){

        $product = Product::findOrFail($id);
        $product->status = '1';
        if ($product->save()) {
            return redirect()->back();
        }
    }
    public function hideStatus($id){

        $product = Product::findOrFail($id);
        $product->status = '0';
        if ($product->save()) {
            return redirect()->back();
        }
    }

}
