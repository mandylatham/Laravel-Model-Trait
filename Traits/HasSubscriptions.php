<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\Subscription;

/**
 * Has Subscriptions Relations Trait
 *
 * @copyright    2020 MdRepTime, LLC
 * @subscription App\Models\Traits
 */
trait HasSubscriptions
{
    /**
     * Returns subscriptions model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function subscriptions()
    {
        return $this->belongsToMany(Subscription::class);
    }

    /**
     * Determines if has any subscription
     *
     * @return bool
     * @access public
     */
    public function hasSubscriptions(): bool
    {
        return ($this->subscriptions()->count() !== 0) ? true : false;
    }

    /**
     * Determines if has a given subscription
     *
     * @param  App\Models\System\Subscription|int $subscription
     * @return bool
     * @access public
     */
    public function hasSubscription($subscription): bool
    {
        if (filled($subscription)) {
            if (is_numeric($subscription) && is_finite(intval($subscription))) {
                return $this->subscriptions()->where('id', intval($subscription))->exists();
            }

            if ($subscription instanceof Subscription) {
                return $this->subscriptions()->where('id', $subscription->id)->exists();
            }
        }

        return false;
    }

    /**
     * Assign a given subscription
     *
     * @param  App\Models\System\Subscription|int $subscription
     * @return bool
     * @access public
     */
    public function assignSubscription($subscription): bool
    {
        if (!$this->hasSubscription($subscription)) {
            if (is_numeric($subscription) && is_finite(intval($subscription))) {
                $subscription = Subscription::where('id', intval($subscription))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($subscription instanceof Subscription) {
                return ($this->subscriptions()->save($subscription)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }


    /**
     * Unassign a given subscription
     *
     * @param  App\Models\System\Subscription|int $subscription
     * @return bool
     * @access public
     */
    public function unassignSubscription($subscription): bool
    {
        if ($this->hasSubscription($subscription)) {
            if (is_numeric($subscription) && is_finite(intval($subscription))) {
                return ($this->subscriptions()->detach(intval($subscription))) ? true : false;
            }

            if ($subscription instanceof Subscription) {
                return ($this->subscriptions()->detach($subscription->id)) ? true : false;
            }
        }

        return true;
    }
}
