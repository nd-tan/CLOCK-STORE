<?php

namespace App\Policies;

use App\Models\Order;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Order  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Order $order)
    {
        return $order->hasPermission('Order_viewAny');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Order  $user
     * @param  \App\Models\Order  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Order $order, Order $model)
    {
        return $order->hasPermission('Order_view');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Order  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Order $order)
    {
         return $order->hasPermission('Order_create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Order  $user
     * @param  \App\Models\Order  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Order $order, Order $model)
    {
        return $order->hasPermission('Order_update');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Order  $user
     * @param  \App\Models\Order  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Order $order, Order $model)
    {
        return $order->hasPermission('Order_delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Order  $user
     * @param  \App\Models\Order  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Order $order, Order $model)
    {
        return $order->hasPermission('Order_restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Order  $user
     * @param  \App\Models\Order  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Order $order, Order $model)
    {
        return $order->hasPermission('Order_forceDelete');
    }
}
