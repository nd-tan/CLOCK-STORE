<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'orders';
    function products(){
        return $this->belongsToMany(OrderDetail::class);
    }
    function customer(){
        return $this->belongsTo(Customer::class);
    }
    function orderDetails(){
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
    function province(){
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }
    function district(){
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
    function ward(){
        return $this->belongsTo(Ward::class, 'ward_id', 'id');
    }
    public function scopeSearch($query, $term)
    {
        if ($term) {
            $query->join('customers','customers.id','orders.customer_id')->where('name_customer', 'like', '%' . $term . '%')
                ->orWhere('phone', 'like', '%' . $term . '%')
                ->orWhere('id', 'like', '%' . $term . '%')
                ->orWhere('total', 'like', '%' . $term . '%');
        }
        return $query;
    }
    // $orders = $this->model->select('*');
    // if (!empty($request->search)) {
    //     $search = $request->search;
    //     $orders = $orders->Search($search);
    // }
    // $orders->filterPrice(request(['startPrice', 'endPrice']));
    // $orders->filterDate(request(['start_date', 'end_date']));
    // $orders->status($request);
    // $orders->Type($request);
    // return $orders->orderBy('id', 'DESC')->paginate(5);
    public function scopeFilterPrice($query, array $filters)
    {
        if (isset($filters['startPrice']) && isset($filters['endPrice'])) {
            $query->WhereBetween('total', [$filters['startPrice'], $filters['endPrice']]);
        }
        return $query;
    }
    public function scopefilterDate($query, array $date_to_date)
    {
        if (isset($date_to_date['start_date']) && isset($date_to_date['end_date'])) {
            $query->whereBetween('created_at', [$date_to_date['start_date'], $date_to_date['end_date']]);
        }
        return $query;
    }
    public function scopeStatus($query, $request)
    {
        if ($request->has('status')) {
            $query->where('orders.status', $request->status);
        };
        return $query;
    }
    public function scopeType($query, $request)
    {
        if ($request->has('gender')) {
            return $query->join('order_details','order_details.order_id','orders.id')->join('products','products.id','order_details.product_id')->where('type_gender', $request->gender);
        };
        return $query;
    }
}