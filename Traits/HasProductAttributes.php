<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\ProductAttribute;

/**
 * Has Product Attributes Relations Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasProductAttributes
{
    /**
     * Returns all product attributes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function productAttributes()
    {
        return $this->belongsToMany(ProductAttribute::class);
    }

    /**
     * Determines if has any product attributes
     *
     * @return bool
     * @access public
     */
    public function hasProductAttributes(): bool
    {
        return ($this->productAttributes()->count() !== 0) ? true : false;
    }

    /**
     * Determines if has a given product attribute
     *
     * @param App\Models\System\ProductAttribute|int $productAttribute
     *
     * @return bool
     * @access public
     */
    public function hasProductAttribute($productAttribute): bool
    {
        if (filled($productAttribute)) {
            if (is_numeric($productAttribute) && is_finite(intval($productAttribute))) {
                return $this->productAttributes()->where('id', intval($productAttribute))->exists();
            }

            if ($productAttribute instanceof ProductAttribute) {
                return $this->productAttributes()->where('id', $productAttribute->id)->exists();
            }
        }

        return false;
    }

    /**
     * Assign a given product attribute
     *
     * @param App\Models\System\ProductAttribute|int $productAttribute
     *
     * @return bool
     * @access public
     */
    public function assignProductAttribute($productAttribute): bool
    {
        if (!$this->hasProductAttribute($productAttribute)) {
            if (is_numeric($productAttribute) && is_finite(intval($productAttribute))) {
                $productAttribute = ProductAttribute::where('id', intval($productAttribute))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($productAttribute instanceof ProductAttribute) {
                return ($this->productAttributes()->save($productAttribute)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Unassign a given product attribute
     *
     * @param App\Models\System\ProductAttribute|int $productAttribute
     *
     * @return bool
     * @access public
     */
    public function unassignProductAttribute($productAttribute): bool
    {
        if ($this->hasProductAttribute($productAttribute)) {
            if (is_numeric($productAttribute) && is_finite(intval($productAttribute))) {
                return ($this->productAttributes()->detach(intval($productAttribute))) ? true : false;
            }

            if ($productAttribute instanceof ProductAttribute) {
                return ($this->productAttributes()->detach($productAttribute->id)) ? true : false;
            }
        }

        return true;
    }
}
