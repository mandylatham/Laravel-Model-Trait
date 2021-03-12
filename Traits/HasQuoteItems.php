<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\QuoteItem;

/**
 * Has Quote Items Relations Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasQuoteItems
{
    /**
     * Returns all resources
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function quoteItems()
    {
        return $this->belongsToMany(QuoteItem::class);
    }

    /**
     * Determines if has any resources
     *
     * @return bool
     * @access public
     */
    public function hasQuoteItems(): bool
    {
        return ($this->quoteItems()->count() !== 0) ? true : false;
    }

    /**
     * Determines if has a given resource
     *
     * @param App\Models\System\Quote|int $quoteItem
     *
     * @return bool
     * @access public
     */
    public function hasQuoteItem($quoteItem): bool
    {
        if (filled($quoteItem)) {
            if (is_numeric($quoteItem) && is_finite(intval($quoteItem))) {
                return $this->quoteItems()->where('id', intval($quoteItem))->exists();
            }

            if ($quoteItem instanceof Quote) {
                return $this->quoteItems()->where('id', $quoteItem->id)->exists();
            }
        }

        return false;
    }

    /**
     * Assign a given resource
     *
     * @param App\Models\System\Quote|int $quoteItem
     *
     * @return bool
     * @access public
     */
    public function assignQuote($quoteItem): bool
    {
        if (!$this->hasQuoteItem($quoteItem)) {
            if (is_numeric($quoteItem) && is_finite(intval($quoteItem))) {
                $quoteItem = QuoteItem::where('id', intval($quoteItem))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($quoteItem instanceof Quote) {
                return ($this->quoteItems()->save($quoteItem)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Unassign a given resource
     *
     * @param App\Models\System\Quote|int $quoteItem
     *
     * @return bool
     * @access public
     */
    public function unassignQuote($quoteItem): bool
    {
        if ($this->hasQuoteItem($quoteItem)) {
            if (is_numeric($quoteItem) && is_finite(intval($quoteItem))) {
                return ($this->quoteItems()->detach(intval($quoteItem))) ? true : false;
            }

            if ($quoteItem instanceof Quote) {
                return ($this->quoteItems()->detach($quoteItem->id)) ? true : false;
            }
        }

        return true;
    }
}
