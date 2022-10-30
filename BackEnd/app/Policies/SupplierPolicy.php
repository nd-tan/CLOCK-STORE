<?php

namespace App\Policies;

use App\Models\Supplier;
use Illuminate\Auth\Access\HandlesAuthorization;

class SupplierPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Supplier $supplier)
    {
        return $supplier->hasPermission('Supplier_viewAny');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Supplier  $user\
     * @param  \App\Models\Supplier  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Supplier $supplier, Supplier $model)
    {
        return $supplier->hasPermission('Supplier_view');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Supplier $supplier)
    {
         return $supplier->hasPermission('Supplier_create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Supplier  $user
     * @param  \App\Models\Supplier  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Supplier $supplier, Supplier $model)
    {
        return $supplier->hasPermission('Supplier_update');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Supplier  $user
     * @param  \App\Models\Supplier  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Supplier $supplier, Supplier $model)
    {
        return $supplier->hasPermission('Supplier_delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Supplier  $user
     * @param  \App\Models\Supplier  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Supplier $supplier, Supplier $model)
    {
        return $supplier->hasPermission('Supplier_restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Supplier  $user
     * @param  \App\Models\Supplier  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Supplier $supplier, Supplier $model)
    {
        return $supplier->hasPermission('Supplier_forceDelete');
    }
}

