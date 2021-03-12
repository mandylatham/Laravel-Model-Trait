<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\Invoice;

/**
 * Has Invoice Relations Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasInvoices
{
    /**
     * Returns Invoice relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function invoices()
    {
        return $this->belongsToMany(Invoice::class);
    }

    /**
     * Determines if has any invoices
     *
     * @return bool
     * @access public
     */
    public function hasInvoices()
    {
        return ($this->invoices()->count() !== 0) ? true : false;
    }

    /**
     * Determines if has a given invoice
     *
     * @param  App\Models\System\Invoice|int $invoice
     * @return bool
     * @access public
     */
    public function hasInvoice($invoice)
    {
        if (filled($invoice)) {
            if (is_numeric($invoice) && is_finite(intval($invoice))) {
                return $this->Invoice()->where('id', intval($invoice))->exists();
            }

            if ($invoice instanceof Invoice) {
                return $this->Invoice()->where('id', $invoice->id)->exists();
            }
        }

        return true;
    }

    /**
     * Assigns a given invoice
     *
     * @param  App\Models\System\Invoice|int $invoice
     * @return bool
     * @access public
     */
    public function assignInvoice($invoice)
    {
        if (!$this->hasInvoice($invoice)) {
            if (is_numeric($invoice) && is_finite(intval($invoice))) {
                $invoice = Invoice::where('id', intval($invoice))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($invoice instanceof Invoice) {
                return ($this->invoices()->save($invoice)) ? true : false;
            }
        }

        return true;
    }


    /**
     * Unassign a given invoice
     *
     * @param  App\Models\System\Invoice|int $invoice
     * @return bool
     * @access public
     */
    public function unassignInvoice($invoice)
    {
        if ($this->hasInvoice($invoice)) {
            if (is_numeric($invoice) && is_finite(intval($invoice))) {
                return ($this->Invoice()->detach(intval($invoice))) ? true : false;
            }

            if ($invoice instanceof Invoice) {
                return ($this->Invoice()->detach($invoice->id)) ? true : false;
            }
        }

        return true;
    }
}
