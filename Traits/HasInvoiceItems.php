<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\InvoiceItem;

/**
 * Has Invoices Items Relations Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasInvoiceItems
{
    /**
     * Returns all resources relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function invoiceItems()
    {
        return $this->belongsToMany(InvoiceItem::class);
    }

    /**
     * Determines if has any resources
     *
     * @return bool
     * @access public
     */
    public function hasInvoiceItems(): bool
    {
        return ($this->invoices()->count() !== 0) ? true : false;
    }

    /**
     * Determines if has a given invoice
     *
     * @param App\Models\System\InvoiceItem|int $invoiceItem
     *
     * @return bool
     * @access public
     */
    public function hasInvoiceItem($invoiceItem): bool
    {
        if (filled($invoiceItem)) {
            if (is_numeric($invoiceItem) && is_finite(intval($invoiceItem))) {
                return $this->invoices()->where('id', intval($invoiceItem))->exists();
            }

            if ($invoiceItem instanceof InvoiceItem) {
                return $this->invoices()->where('id', $invoiceItem->id)->exists();
            }
        }

        return false;
    }

    /**
     * Assign a given resource
     *
     * @param App\Models\System\InvoiceItem|int $invoiceItem
     *
     * @return bool
     * @access public
     */
    public function assignInvoiceItem($invoiceItem): bool
    {
        if (!$this->hasInvoice($invoiceItem)) {
            if (is_numeric($invoiceItem) && is_finite(intval($invoiceItem))) {
                $invoiceItem = InvoiceItem::where('id', intval($invoiceItem))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($invoiceItem instanceof InvoiceItem) {
                return ($this->invoices()->save($invoiceItem)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Unassign a given resource
     *
     * @param App\Models\System\InvoiceItem|int $invoiceItem
     *
     * @return bool
     * @access public
     */
    public function unassignInvoiceItem($invoiceItem): bool
    {
        if ($this->hasInvoice($invoiceItem)) {
            if (is_numeric($invoiceItem) && is_finite(intval($invoiceItem))) {
                return ($this->invoices()->detach(intval($invoiceItem))) ? true : false;
            }

            if ($invoiceItem instanceof InvoiceItem) {
                return ($this->invoices()->detach($invoiceItem->id)) ? true : false;
            }
        }

        return true;
    }
}
