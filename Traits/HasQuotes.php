<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\Quote;

/**
 * Has Quotes Relations Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasQuotes
{
    /**
     * Returns all resources
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function quotes()
    {
        return $this->belongsToMany(Quote::class);
    }

    /**
     * Determines if has any resources
     *
     * @return bool
     * @access public
     */
    public function hasQuotes(): bool
    {
        return ($this->quotes()->count() !== 0) ? true : false;
    }

    /**
     * Determines if has a given resource
     *
     * @param App\Models\System\Quote|int $quote
     *
     * @return bool
     * @access public
     */
    public function hasQuote($quote): bool
    {
        if (filled($quote)) {
            if (is_numeric($quote) && is_finite(intval($quote))) {
                return $this->quotes()->where('id', intval($quote))->exists();
            }

            if ($quote instanceof Quote) {
                return $this->quotes()->where('id', $quote->id)->exists();
            }
        }

        return false;
    }

    /**
     * Assign a given resource
     *
     * @param App\Models\System\Quote|int $quote
     *
     * @return bool
     * @access public
     */
    public function assignQuote($quote): bool
    {
        if (!$this->hasQuote($quote)) {
            if (is_numeric($quote) && is_finite(intval($quote))) {
                $quote = Quote::where('id', intval($quote))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($quote instanceof Quote) {
                return ($this->quotes()->save($quote)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Unassign a given resource
     *
     * @param App\Models\System\Quote|int $quote
     *
     * @return bool
     * @access public
     */
    public function unassignQuote($quote): bool
    {
        if ($this->hasQuote($quote)) {
            if (is_numeric($quote) && is_finite(intval($quote))) {
                return ($this->quotes()->detach(intval($quote))) ? true : false;
            }

            if ($quote instanceof Quote) {
                return ($this->quotes()->detach($quote->id)) ? true : false;
            }
        }

        return true;
    }
}
