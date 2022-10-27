<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        return view('admin.products.index', compact('products'));
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

    public function store(Request $request)
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
        return view('back-end.product.show',compact('product'));
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            $this->productService->update($id, $data);
            $notification = array(
                'message' => 'Edited product successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('product.index')->with($notification);
        } catch (Exception $e) {
            Log::error('errors' . $e->getMessage() . ' getLine' . $e->getLine());
            $notification = array(
                'message' => 'Edited product faill',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->productService->delete($id);
        return response()->json($product);
    }
    public function getTrashed()
    {
        $products = $this->productService->getTrashed();
        return view('back-end.product.softDelete', compact('products'));
    }
    public function restore($id)
    {
        $this->productService->restore($id);
        $notification = array(
            'message' => 'Restore product successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('product.getTrashed')->with($notification);
    }
    public function force_destroy($id)
    {
        try {

        $product = $this->productService->force_destroy($id);
        return response()->json($product);

        }catch (Exception $e) {
            Log::error('errors' . $e->getMessage() . ' getLine' . $e->getLine());
            $notification = array(
                'message' => 'Deleted product faill',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
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
