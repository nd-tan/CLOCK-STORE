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
}