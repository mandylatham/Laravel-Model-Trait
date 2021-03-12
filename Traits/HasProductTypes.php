<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\ProductType;

/**
 * Has Product Type Relations Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasProductTypes
{
    /**
     * Returns all product types
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function productTypes()
    {
        return $this->belongsToMany(ProductType::class);
    }

    /**
     * Determines if has any product types
     *
     * @return bool
     * @access public
     */
    public function hasProductTypes(): bool
    {
        return ($this->productTypes()->count() !== 0) ? true : false;
    }

    /**
     * Determines if has a given product type
     *
     * @param App\Models\System\ProductType|int $productType
     *
     * @return bool
     * @access public
     */
    public function hasProductType($productType): bool
    {
        if (filled($productType)) {
            if (is_numeric($productType) && is_finite(intval($productType))) {
                return $this->productTypes()->where('id', intval($productType))->exists();
            }

            if ($productType instanceof ProductType) {
                return $this->productTypes()->where('id', $productType->id)->exists();
            }
        }

        return false;
    }

    /**
     * Assign a given product type
     *
     * @param App\Models\System\ProductType|int $productType
     *
     * @return bool
     * @access public
     */
    public function assignProductType($productType): bool
    {
        if (!$this->hasProductType($productType)) {
            if (is_numeric($productType) && is_finite(intval($productType))) {
                $productType = ProductType::where('id', intval($productType))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($productType instanceof ProductType) {
                return ($this->productTypes()->save($productType)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Unassign a given product type
     *
     * @param App\Models\System\ProductType|int $productType
     *
     * @return bool
     * @access public
     */
    public function unassignProductType($productType): bool
    {
        if ($this->hasProductType($productType)) {
            if (is_numeric($productType) && is_finite(intval($productType))) {
                return ($this->productTypes()->detach(intval($productType))) ? true : false;
            }

            if ($productType instanceof ProductType) {
                return ($this->productTypes()->detach($productType->id)) ? true : false;
            }
        }

        return true;
    }
}
