<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\Order;

/**
 * Has Orders Relations Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasOrders
{
    /**
     * Gets Orders
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    /**
     * Determins if has any orders
     *
     * @return bool
     * @access public
     */
    public function hasOrders(): bool
    {
        return ($this->orders->count()) ? true : false;
    }

    /**
     * Determines if has the given order
     *
     * @param  App\Models\System\Order|int $order
     * @return bool
     * @access public
     */
    public function hasOrder($order): bool
    {
        if (filled($order)) {
            if (is_numeric($order) && is_finite(intval($order))) {
                return $this->orders()->where('id', intval($order))->exists();
            }

            if ($order instanceof Order) {
                return $this->orders()->where('id', $order->id)->exists();
            }
        }

        return false;
    }

    /**
     * Assign the given order
     *
     * @param  App\Models\System\Order|int $order
     * @return bool
     * @access public
     */
    public function assignOrder($order): bool
    {
        if (!$this->hasOrder($order)) {
            if (is_numeric($order) && is_finite(intval($order))) {
                $order = Order::where('id', intval($order))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($order instanceof Order) {
                return ($this->orders()->saveOrFail($order)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Unassign the given order
     *
     * @param  App\Models\System\Order|int $order
     * @return bool
     * @access public
     */
    public function unassignOrder($order): bool
    {
        if ($this->hasOrder($order)) {
            if (is_numeric($order) && is_finite(intval($order))) {
                return ($this->orders()->detach(intval($order))) ? true : false;
            }

            if ($order instanceof Order) {
                return ($this->orders()->detach($order->id)) ? true : false;
            }
        }

        return true;
    }
}
