<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\Appointment;

/**
 * Has Appointments Relation Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasAppointments
{
    /**
     * Gets appointments
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function appointments()
    {
        return $this->belongsToMany(Appointment::class);
    }

    /**
     * Checks if has any appointment
     *
     * @return bool
     * @access public
     */
    public function hasAppointments(): bool
    {
        return ($this->appointments->count() !== 0) ? true : false;
    }

    /**
     * Determines if has the given appointment
     *
     * @param App\Models\System\Appointment|int|string $appointment
     *
     * @return bool
     * @access public
     */
    public function hasAppointment($appointment): bool
    {
        if (filled($appointment)) {
            if (is_numeric($appointment) && is_finite(intval($appointment))) {
                return $this->appointments()->where('id', intval($appointment))->exists();
            }

            if ($appointment instanceof Appointment) {
                return $this->appointments()->where('id', $appointment->id)->exists();
            } else {
                return false;
            }
        }

        return false;
    }

    /**
     * Assign the given appointment
     *
     * @param App\Models\System\Appointment|int|string $appointment
     *
     * @return bool
     * @access public
     */
    public function assignAppointment($appointment): bool
    {
        if (!$this->hasAppointment($appointment)) {
            if (is_numeric($appointment) && is_finite(intval($appointment))) {
                $appointment = Appointment::where('id', intval($appointment))
                    ->select(['id'])
                    ->findOrFail();
            }

            if ($appointment instanceof Appointment) {
                return ($this->appointments()->save($appointment)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Assign the given appointment
     *
     * @param App\Models\System\Appointment|int|string $appointment
     *
     * @return bool
     * @access public
     */
    public function unassignAppointment($appointment): bool
    {
        if ($this->hasAppointment($appointment)) {
            if (is_numeric($appointment) && is_finite(intval($appointment))) {
                $appointment = $this->appointments()->where('id', intval($appointment))
                    ->select(['id'])
                    ->findOrFail();
            }

            if ($appointment instanceof Appointment) {
                return ($this->appointments()->detach($appointment->id)) ? true : false;
            }
        }

        return false;
    }
}
