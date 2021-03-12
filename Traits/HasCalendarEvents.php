<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\CalendarEvent;

/**
 * Has CalendarEvents Relation Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasCalendarEvents
{
    /**
     * Gets calendarEvents
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function calendarEvents()
    {
        return $this->belongsToMany(CalendarEvent::class);
    }

    /**
     * Checks if has any calendarEvent
     *
     * @return bool
     * @access public
     */
    public function hasCalendarEvents(): bool
    {
        return ($this->calendarEvents->count() !== 0) ? true : false;
    }

    /**
     * Determines if has the given calendarEvent
     *
     * @param App\Models\System\CalendarEvent|int|string $calendarEvent
     *
     * @return bool
     * @access public
     */
    public function hasCalendarEvent($calendarEvent): bool
    {
        if (filled($calendarEvent)) {
            if (is_numeric($calendarEvent) && is_finite(intval($calendarEvent))) {
                return $this->calendarEvents()->where('id', intval($calendarEvent))->exists();
            }

            if ($calendarEvent instanceof CalendarEvent) {
                return $this->calendarEvents()->where('id', $calendarEvent->id)->exists();
            } else {
                return false;
            }
        }

        return false;
    }

    /**
     * Assign the given calendarEvent
     *
     * @param App\Models\System\CalendarEvent|int|string $calendarEvent
     *
     * @return bool
     * @access public
     */
    public function assignCalendarEvent($calendarEvent): bool
    {
        if (!$this->hasCalendarEvent($calendarEvent)) {
            if (is_numeric($calendarEvent) && is_finite(intval($calendarEvent))) {
                $calendarEvent = CalendarEvent::where('id', intval($calendarEvent))
                    ->select(['id'])
                    ->findOrFail();
            }

            if ($calendarEvent instanceof CalendarEvent) {
                return ($this->calendarEvents()->save($calendarEvent)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Assign the given calendarEvent
     *
     * @param App\Models\System\CalendarEvent|int|string $calendarEvent
     *
     * @return bool
     * @access public
     */
    public function unassignCalendarEvent($calendarEvent): bool
    {
        if ($this->hasCalendarEvent($calendarEvent)) {
            if (is_numeric($calendarEvent) && is_finite(intval($calendarEvent))) {
                $calendarEvent = $this->calendarEvents()->where('id', intval($calendarEvent))
                    ->select(['id'])
                    ->findOrFail();
            }

            if ($calendarEvent instanceof CalendarEvent) {
                return ($this->calendarEvents()->detach($calendarEvent->id)) ? true : false;
            }
        }

        return false;
    }
}
