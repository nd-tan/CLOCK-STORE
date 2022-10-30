<?php

namespace App\Policies;

use App\Models\Customer;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Customer  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Customer $customer)
    {
        return $customer->hasPermission('Customer_viewAny');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Customer  $user
     * @param  \App\Models\Customer  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Customer $customer, Customer $model)
    {
        return $customer->hasPermission('Customer_view');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Customer  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Customer $customer)
    {
         return $customer->hasPermission('Customer_create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Customer  $user
     * @param  \App\Models\Customer  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Customer $customer, Customer $model)
    {
        return $customer->hasPermission('Customer_update');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Customer  $user
     * @param  \App\Models\Customer  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Customer $customer, Customer $model)
    {
        return $customer->hasPermission('Customer_delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Customer  $user
     * @param  \App\Models\Customer  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Customer $customer, Customer $model)
    {
        return $customer->hasPermission('Customer_restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Customer  $user
     * @param  \App\Models\Customer  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Customer $customer, Customer $model)
    {
        return $customer->hasPermission('Customer_forceDelete');
    }
}
