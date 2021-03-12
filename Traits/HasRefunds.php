<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\Refund;

/**
 * Has Refunds Relations Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasRefunds
{
    /**
     * Returns all assigned refunds.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function refunds()
    {
        return $this->belongsToMany(Refund::class);
    }

    /**
     * Determines if has any refunds
     *
     * @return bool
     * @access public
     */
    public function hasRefunds(): bool
    {
        return ($this->refunds()->count() !== 0) ?  true : false;
    }

    /**
     * Determines if has assigned refund
     *
     * @param  App\Models\System\Refund|int $refund
     * @return bool
     * @access public
     */
    public function hasRefund($refund): bool
    {
        if (filled($refund)) {
            if (is_numeric($refund) && is_finite(intval($refund))) {
                return $this->refunds()
                    ->where('id', intval($refund))
                    ->exists();
            }

            if ($refund instanceof Refund) {
                return $this->refunds()->where('id', $refund->id)->exists();
            } else {
                return false;
            }
        }

        return false;
    }

    /**
     * Assigns a given refund
     *
     * @param  App\Models\System\Refund|int $refund
     * @return bool
     * @access public
     */
    public function assignRefund($refund): bool
    {
        if (!$this->hasRefund($refund)) {
            if (is_numeric($refund) && is_finite(intval($refund))) {
                $refund = Refund::where('id', intval($refund))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($refund instanceof Refund) {
                return ($this->refunds()->save($refund)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Unassign a given refund
     *
     * @param  App\Models\System\Refund|int $refund
     * @return bool
     * @access public
     */
    public function unassignRefund($refund): bool
    {
        if ($this->hasRefund($refund)) {
            if (is_numeric($refund) && is_finite(intval($refund))) {
                return ($this->refunds()->detach(intval($refund))) ? true : false;
            }

            if ($refund instanceof Refund) {
                return ($this->refunds()->detach($refund->id)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }
}
