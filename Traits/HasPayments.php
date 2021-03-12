<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\Payment;

/**
 * Has Payment Relations Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasPayments
{
    /**
     * Returns payments model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function payments()
    {
        return $this->belongsToMany(Payment::class);
    }

    /**
     * Determines if has any payments
     *
     * @return bool
     * @access public
     */
    public function hasPayments()
    {
        return ($this->payments()->count()) ? true : false;
    }

    /**
     * Determine has a given payment
     *
     * @param  App\Models\System\Payment|int $payment
     * @return bool
     * @access public
     */
    public function hasPayment($payment): bool
    {
        if (filled($payment)) {
            if (is_numeric($payment) && is_finite(intval($payment))) {
                return $this->payments()
                    ->where('id', intval($payment))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($payment instanceof Payment) {
                return $this->payments()
                    ->where('id', $payment)
                    ->select(['id'])
                    ->firstOrFail();
            } else {
                return false;
            }
        }

        return false;
    }

    /**
     * Assigns a given payment
     *
     * @param  App\Models\System\Payment|int $payment
     * @return bool
     * @access public
     */
    public function assignPayment($payment): bool
    {
        if (!$this->hasPayment($payment)) {
            if (is_numeric($payment) && is_finite(intval($payment))) {
                $payment = Payment::where('id', $payment)
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($payment instanceof Payment) {
                return ($this->payments()->save($payment)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Unassigns a given payment
     *
     * @param  App\Models\System\Payment|int $payment
     * @return bool
     * @access public
     */
    public function unassignPayment($payment): bool
    {
        if ($this->hasPayment($payment)) {
            if (is_numeric($payment) && is_finite(intval($payment))) {
                return ($this->payments()->detach(intval($payment))) ? true : false;
            }

            if ($payment instanceof Payment) {
                return ($this->payments()->detach($payment->id)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }
}
