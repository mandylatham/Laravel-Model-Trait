<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\SupportTicket;

/**
 * Has Support Ticket Relations Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasSupportTickets
{
    /**
     * Support Ticket Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function supportTickets()
    {
        return $this->belongsToMany(SupportTicket::class);
    }

    /**
     * Determines if has any support tickets
     *
     * @return bool
     * @access public
     */
    public function hasSupportTickets()
    {
        return ($this->supportTickets()->count() !== 0) ? true : false;
    }

    /**
     * Determines if has a given support ticket
     *
     * @param  App\Models\System\SupportTicket|int $supportTicket
     * @return bool
     * @access public
     */
    public function hasSupportTicket($supportTicket): bool
    {
        if (filled($supportTicket)) {
            if (is_numeric($supportTicket) && is_finite(intval($supportTicket))) {
                return $this->supportTickets()->where('id', intval($supportTicket))->exists();
            }

            if ($supportTicket instanceof SupportTicket) {
                return $this->supportTickets()->where('id', $supportTicket->id)->exists();
            } else {
                return false;
            }
        }

        return false;
    }

    /**
     * Assigns a given support ticket
     *
     * @param  App\Models\System\SupportTicket|int $supportTicket
     * @return bool
     * @access public
     */
    public function assignSupportTicket($supportTicket): bool
    {
        if (!$this->hasSupportTicket($supportTicket)) {
            if (is_numeric($supportTicket) && is_finite(intval($supportTicket))) {
                $supportTicket = SupportTicket::where('id', intval($supportTicket))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($supportTicket instanceof SupportTicket) {
                return ($this->supportTickets()->save($supportTicket->id)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }


    /**
     * Unassign a given support ticket
     *
     * @param  App\Models\System\SupportTicket|int $supportTicket
     * @return bool
     * @access public
     */
    public function unassignSupportTicket($supportTicket): bool
    {
        if ($this->hasSupportTicket($supportTicket)) {
            if (is_numeric($supportTicket) && is_finite(intval($supportTicket))) {
                return ($this->supportTickets()->detach(intval($supportTicket))) ? true : false;
            }

            if ($supportTicket instanceof SupportTicket) {
                return ($this->supportTickets()->detach($supportTicket->id)) ? true : false;
            }
        }

        return true;
    }
}
