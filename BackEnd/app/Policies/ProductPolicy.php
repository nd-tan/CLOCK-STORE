<?php

namespace App\Policies;

use App\Models\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Product  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Product $product)
    {
        return $product->hasPermission('Product_viewAny');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Product  $user
     * @param  \App\Models\Product  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Product $product, Product $model)
    {
        return $product->hasPermission('Product_view');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Product  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Product $product)
    {
         return $product->hasPermission('Product_create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Product  $user
     * @param  \App\Models\Product  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Product $product, Product $model)
    {
        return $product->hasPermission('Product_update');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Product  $user
     * @param  \App\Models\Product  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Product $product, Product $model)
    {
        return $product->hasPermission('Product_delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Product  $user
     * @param  \App\Models\Product  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Product $product, Product $model)
    {
        return $product->hasPermission('Product_restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Product  $user
     * @param  \App\Models\Product  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Product $product, Product $model)
    {
        return $product->hasPermission('Product_forceDelete');
    }
}
