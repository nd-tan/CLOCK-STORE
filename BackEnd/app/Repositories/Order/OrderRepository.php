<?php
namespace App\Repositories\Order;

use App\Models\Order;
use App\Repositories\BaseRepository;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface{
    function getModel(){
        return Order::class;
    }
    // public function all($request)
    // {
    //     dd(1);
    //     $orders = $this->model->where('created_at', '>', now()->subMonths(3));
    //     if (!empty($request->search)) {
    //         $search = $request->search;
    //         $orders = $orders->search($search);
    //     }
    //     if (!empty($request->category_id)) {
    //     $orders->nameCate($request)
    //         ->filterPrice(request(['startPrice', 'endPrice']))
    //         ->filterDate(request(['start_date', 'end_date']))
    //         ->status($request);
    //     }

    //     $orders->filterPrice(request(['startPrice', 'endPrice']));
    //     $orders->filterDate(request(['start_date', 'end_date']));
    //     $orders->status($request);



    //     return $orders->orderBy('id', 'DESC')->paginate(5);
    // }

    public function getAllWithPaginateLatest($request)
    {
        $orders = $this->model->select('*');
        if (!empty($request->search)) {
            $search = $request->search;
            $orders = $orders->Search($search);
        }
        $orders->filterPrice(request(['startPrice', 'endPrice']));
        $orders->filterDate(request(['start_date', 'end_date']));
        $orders->status($request);
        $orders->Type($request);
        return $orders->orderBy('orders.id', 'DESC')->paginate(5);
    }

    // function getAllWithPaginateLatest($request){
    //     $orders = $this->model->latest()->paginate(10);
    //     if(isset($request->search)){
    //         $orders = $this->model
    //         ->where('name_customer', 'LIKE', '%'.$request->search.'%')
    //         ->orWhere('id', 'LIKE', '%'.$request->search.'%')
    //         ->orWhere('phone', 'LIKE', '%'.$request->search.'%')
    //         ->paginate(10);
    //     }
    //     return $orders;
    // }
    function updateSingle($id){
        $order = $this->model->find($id);
        $order->update(['status' => 1]);
        return $order;
    }
}