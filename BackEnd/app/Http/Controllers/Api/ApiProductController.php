<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Services\Api\Product\ApiProductServiceInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiProductController extends Controller
{
    private $FeproductService;
    public function __construct(ApiProductServiceInterface $FeproductService)
    {
        $this->FeproductService = $FeproductService;
    }
    public function product_list()
    {
        $products = $this->FeproductService->getAll();

        return response()->json($products, 200);
    }
    public function search(Request $request)
    {
            $products = $this->FeproductService->search($request);
            return response()->json($products, 200);
    }

    public function product_detail($id)
    {
        $product = $this->FeproductService->find($id);
        return response()->json($product, 200);
    }
    public function category_list()
    {
        $categories = Category::with('products')->take(10)->get();
        return response()->json($categories, 200);
    }
    public function trendingProduct()
    {
        $products = $this->FeproductService->trendingProduct();
        return response()->json($products, 200);
    }

    public function getCustomer()
    {
        $customer = Customer::get();
        return response()->json($customer, 200);
    }
}
