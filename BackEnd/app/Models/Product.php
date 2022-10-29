<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
<<<<<<< HEAD
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name', 'quantity', 'price', 'description', 'image',
         'status', 'category_id', 'brand_id', 'supplier_id', 'type_gender'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
=======
    use HasFactory,SoftDeletes;
    protected $table = 'products';
>>>>>>> 65e4b3bfdf4bc64d2553e9e24543b3c781a44fb2
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function orderDetails(){
        return $this->hasMany(OrderDetail::class, 'product_id','id');
    }
    public function image_products(){
        return $this->hasMany(ImageProducts::class, 'product_id','id');
    }
<<<<<<< HEAD
    public function scopeNameCate($query, $request)
    {
        if ($request->has('category_id')) {
            return $query->whereHas('category', function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            });
        }
    }
    public function scopeNameSupp($query, $request)
    {
        if ($request->has('supplier_id')) {
            return $query->whereHas('supplier', function ($query) use ($request) {
                $query->where('supplier_id', $request->supplier_id);
            });
        }
    }
    public function scopeNameBran($query, $request)
    {
        if ($request->has('brand_id')) {
            return $query->whereHas('brand', function ($query) use ($request) {
                $query->where('brand_id', $request->brand_id);
            });
        }
    }
    public function scopeFilterPrice($query, array $filters)
    {
        if (isset($filters['startPrice']) && isset($filters['endPrice'])) {
            $query->whereBetween('price', [$filters['startPrice'], $filters['endPrice']]);
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
            $query->where('status', $request->status);
        };
        return $query;
    }
    public function scopeType($query, $request)
    {
        if ($request->has('type_gender')) {
            $query->where('type_gender', $request->type_gender);
        };
        return $query;
    }
}
=======
    public function categories()
    {
        return $this->belongsTo(Category::class);
    }
}
>>>>>>> 65e4b3bfdf4bc64d2553e9e24543b3c781a44fb2
