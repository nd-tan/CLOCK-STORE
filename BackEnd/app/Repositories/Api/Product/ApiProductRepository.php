<?php

namespace App\Repositories\Api\Product;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Repositories\Api\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApiProductRepository extends BaseRepository implements ApiProductRepositoryInterface
{

    function getModel()
    {
        return Product::class;
    }
    public function getAll()
    {
        $products = $this->model->take(15)->get();
        return $products;
    }
    public function search($request)
    {
        $query = $this->model::query();
        $data = $request->input('search');
        if ($data) {
            $query->whereRaw("name Like '%" . $data . "%' ")
                ->orWhereRaw("price Like '%" .$data . "%' ")
                ->orWhereRaw("description Like '%" .$data . "%' ")
            ;
        }
        return $query->get();
    }
    public function find($id)
    {
        $product = $this->model
            ->with([
                'image_products', 'brand', 'category', 'supplier'
                => function ($query) {
                    return $query->with([
                        'answers'
                        => function ($query) {
                            return $query->with('customer');
                        }
                    ]);
                }
            ])->find($id);
        return $product;
    }
    public function trendingProduct()
    {
        $toptrending = DB::table('order_details')
            ->leftJoin('products', 'products.id', '=', 'order_details.product_id')
            ->selectRaw('products.*, count(order_details.product_id) totalBy')
            ->groupBy('order_details.product_id')
            ->orderBy('totalBy', 'desc')
            ->take(8)
            ->get();
        return $toptrending;
    }
}
