<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\HasPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasPermissions;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $fillable = [
        'name',
        'address',
        'email',
        'password',
        'phone',
        'birthday',
        'image',
        'gender',
        'province_id',
        'district_id',
        'ward_id',
        'group_id',
    ];
    public function provinces()
    {
        return $this->belongsTo(Province::class,'province_id','id');
    }
    // public function districts()
    // {
    //     return $this->belongsTo(Districts::class);
    // }
    // public function wards()
    // {
    //     return $this->belongsTo(Wards::class);
    // }
    public function groups()
    {
        return $this->belongsTo(Group::class,'group_id','id');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'user_id_ad', 'id');
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // public function hasPermission($permission = null)
    // {
    //     return $this->group->roles->contains('name', $permission);
    // }
}
