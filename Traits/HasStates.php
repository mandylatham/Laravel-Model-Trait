<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\State;

/**
 * Has States Relations Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasStates
{
    /**
     * Returns all states
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function states()
    {
        return $this->belongsToMany(State::class);
    }

    /**
     * Checks if has states
     *
     * @return bool
     */
    public function hasStates(): bool
    {
        return ($this->states()->count() !== 0 ) ? true : false;
    }

    /**
     * Determines if has the given state
     *
     * @param App\Models\System\State|int $state
     *
     * @return bool
     * @access public
     */
    public function hasState($state): bool
    {
        if (filled($state)) {
            if (is_numeric($state) && is_finite(intval($state))) {
                return $this->states()->where('id', intval($state))->exists();
            }

            if ($state instanceof State) {
                return $this->states()->where('id', $state->id)->exists();
            }
        }


        return false;
    }

    /**
     * Assign the given state
     *
     * @param App\Models\System\State|int $state
     *
     * @return bool
     * @access public
     */
    public function assignState($state): bool
    {
        if ($this->hasState($state) === false) {
            if (is_numeric($state) && is_finite(intval($state))) {
                $state = State::where('id', intval($state))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($state instanceof State) {
                return ($this->states()->save($state)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }


    /**
     * Unassign the given state
     *
     * @param App\Models\System\State|int $state
     *
     * @return bool
     * @access public
     */
    public function unassignState($state): bool
    {
        if ($this->hasState($state)) {
            if (is_numeric($state) && is_finite(intval($state))) {
                $state = $this->states()->where('id', intval($state))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($state instanceof State) {
                return ($this->states()->detach($state->id)) ? true : false;
            }
        }

        return false;
    }
}
