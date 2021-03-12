<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\Product;

/**
 * Has Products Relations Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @product   App\Models\Traits
 */
trait HasProducts
{
    /**
     * Returns all product model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * Determines if has any product
     *
     * @return bool
     * @access public
     */
    public function hasProducts(): bool
    {
        return ($this->products()->count() !== 0) ? true : false;
    }

    /**
     * Determines if has a given product
     *
     * @param  App\Models\System\Product|int $product
     * @return bool
     * @access public
     */
    public function hasProduct($product): bool
    {
        if (filled($product)) {
            if (is_numeric($product) && is_finite(intval($product))) {
                return $this->products()->where('id', intval($product))->exists();
            }

            if ($product instanceof Product) {
                return $this->products()->where('id', $product->id)->exists();
            }
        }

        return false;
    }

    /**
     * Assign a given product
     *
     * @param  App\Models\System\Product|int $product
     * @return bool
     * @access public
     */
    public function assignProduct($product): bool
    {
        if (!$this->hasProduct($product)) {
            if (is_numeric($product) && is_finite(intval($product))) {
                $product = Product::where('id', intval($product))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($product instanceof Product) {
                return ($this->products()->save($product)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }


    /**
     * Unassign a given product
     *
     * @param  App\Models\System\Product|int $product
     * @return bool
     * @access public
     */
    public function unassignProduct($product): bool
    {
        if ($this->hasProduct($product)) {
            if (is_numeric($product) && is_finite(intval($product))) {
                return ($this->products()->detach(intval($product))) ? true : false;
            }

            if ($product instanceof Product) {
                return ($this->products()->detach($product->id)) ? true : false;
            }
        }

        return true;
    }
}
