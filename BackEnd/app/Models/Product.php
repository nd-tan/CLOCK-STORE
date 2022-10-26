<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name', 'quantity', 'price', 'description', 'image', 'status', 'category_id', 'brand_id', 'supplier_id'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function product_images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function scopeSearch($query, $term)
    {
        if ($term) {
            $query->where('name', 'like', '%' . $term . '%')
                ->orWhere('price', 'like', '%' . $term . '%')
                ->orWhere('status', 'like', '%' . $term . '%')
                ->orWhere('quantity', 'like', '%' . $term . '%');
        }
        return $query;
    }
}
