<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $fillable = ['name', 'group_name'];
    function group_roles()
    {
        return $this->belongsToMany(GroupRole::class);
    }
}
