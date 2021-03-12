<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\Cart;

/**
 * Has Cart Relations Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasCarts
{
    /**
     * Returns cart relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function carts()
    {
        return $this->belongsToMany(Cart::class);
    }

    /**
     * Determines if has any carts
     *
     * @return bool
     * @access public
     */
    public function hasCarts()
    {
        return ($this->carts()->count() !== 0) ? true : false;
    }

    /**
     * Determines if has a given cart
     *
     * @param  App\Models\System\Cart|int $cart
     * @return bool
     * @access public
     */
    public function hasCart($cart)
    {
        if (filled($cart)) {
            if (is_numeric($cart) && is_finite(intval($cart))) {
                return $this->cart()->where('id', intval($cart))->exists();
            }

            if ($cart instanceof Cart) {
                return $this->cart()->where('id', $cart->id)->exists();
            }
        }

        return true;
    }

    /**
     * Assigns a given cart
     *
     * @param  App\Models\System\Cart|int $cart
     * @return bool
     * @access public
     */
    public function assignCart($cart)
    {
        if (!$this->hasCart($cart)) {
            if (is_numeric($cart) && is_finite(intval($cart))) {
                $cart = Cart::where('id', intval($cart))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($cart instanceof Cart) {
                return ($this->carts()->save($cart)) ? true : false;
            }
        }

        return true;
    }


    /**
     * Unassign a given cart
     *
     * @param  App\Models\System\Cart|int $cart
     * @return bool
     * @access public
     */
    public function unassignCart($cart)
    {
        if ($this->hasCart($cart)) {
            if (is_numeric($cart) && is_finite(intval($cart))) {
                return ($this->cart()->detach(intval($cart))) ? true : false;
            }

            if ($cart instanceof Cart) {
                return ($this->cart()->detach($cart->id)) ? true : false;
            }
        }

        return true;
    }
}
