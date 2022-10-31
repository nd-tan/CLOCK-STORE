<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }
    public function scopeSearch($query, $term)
    {
        if ($term) {
            $query
                ->where('customers.name', 'like', '%' . $term . '%')
                ->orWhere('customers.phone', 'like', '%' . $term . '%')
                ->orWhere('customers.id', 'like', '%' . $term . '%')
                ->orWhere('customers.email', 'like', '%' . $term . '%');
        }
        return $query;
    }
    public function scopeFilterName($query, $request)
    {
        if ($request->has('name')) {
            $query->Where('customers.name', 'like', '%' . $request->name . '%');
        }
        return $query;
    }
    public function scopefilterPhone($query, $request)
    {
        if ($request->has('phone')) {
            $query->where('customers.phone','like', '%' . $request->phone . '%' );
        }
        return $query;
    }
    public function scopeEmail($query, $request)
    {
        if ($request->has('email')) {
            $query->where('customers.email','like', '%' . $request->email . '%' );
        };
        return $query;
    }
}