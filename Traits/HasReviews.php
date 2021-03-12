<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\Review;

/**
 * Has Reviews Relations Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasReviews
{
    /**
     * Returns all reviews
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function reviews()
    {
        return $this->belongsToMany(Review::class);
    }

    /**
     * Determines if has any reviews
     *
     * @return bool
     * @access public
     */
    public function hasReviews(): bool
    {
        return ($this->reviews->count() !== 0) ? true : false;
    }

    /**
     * Determines if has a given rating
     *
     * @param  App\Models\System\Review|int $rating
     * @return bool
     * @access public
     */
    public function hasReview($rating): bool
    {
        if (filled($rating)) {
            if (is_numeric($rating) && is_finite(intval($rating))) {
                $rating = Review::where('id', intval($rating))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($rating instanceof Review) {
                return $this->reviews()->where('id', $rating->id)->exists();
            } else {
                return false;
            }
        }

        return false;
    }

    /**
     * Assigns a given rating
     *
     * @param  App\Models\System\Review|int $rating
     * @return bool
     * @access public
     */
    public function assignReview($rating): bool
    {
        if (!$this->hasReview($rating)) {
            if (is_numeric($rating) && is_finite(intval($rating))) {
                $rating = Review::where('id', intval($rating))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($rating instanceof Review) {
                return ($this->reviews()->saveOrfail($rating->id)) ? true : false;
            }
        }

        return true;
    }

    /**
     * Unassign a given rating
     *
     * @param  App\Models\System\Review|int $rating
     * @return bool
     * @access public
     */
    public function unassignReview($rating): bool
    {
        if ($this->hasReview($rating)) {
            if (is_numeric($rating) && is_finite(intval($rating))) {
                return ($this->reviews()->detach(intval($rating))) ? true : false;
            }

            if ($rating instanceof Review) {
                return ($this->reviews()->detach($rating->id)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }
}
