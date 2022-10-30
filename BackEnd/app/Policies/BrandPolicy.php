<?php

namespace App\Policies;

use App\Models\Brand;
use Illuminate\Auth\Access\HandlesAuthorization;

class BrandPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Brand  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Brand $brand)
    {
        return $brand->hasPermission('Brand_viewAny');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Brand  $user
     * @param  \App\Models\Brand  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Brand $brand, Brand $model)
    {
        return $brand->hasPermission('Brand_view');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Brand  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Brand $brand)
    {
         return $brand->hasPermission('Brand_create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Brand  $user
     * @param  \App\Models\Brand  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Brand $brand, Brand $model)
    {
        return $brand->hasPermission('Brand_update');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Brand  $user
     * @param  \App\Models\Brand  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Brand $brand, Brand $model)
    {
        return $brand->hasPermission('Brand_delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Brand $brand, Brand $model)
    {
        return $brand->hasPermission('Brand_restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Brand  $user
     * @param  \App\Models\Brand  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Brand $brand, Brand $model)
    {
        return $brand->hasPermission('Brand_forceDelete');
    }
}
