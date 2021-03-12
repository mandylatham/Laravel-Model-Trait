<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\CartLine;

/**
 * Has Cart Lines Relations Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasCartLines
{
    /**
     * Returns cart lines relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function cartLines()
    {
        return $this->belongsToMany(CartLine::class);
    }

    /**
     * Determines if has any cart lines
     *
     * @return bool
     * @access public
     */
    public function hasCartLines(): bool
    {
        return ($this->cartLines()->count() !== 0) ? true : false;
    }

    /**
     * Determines if has given cart line
     *
     * @param  App\Models\System\CartLine|int $cartLine
     * @return bool
     * @access public
     */
    public function hasCartLine($cartLine): bool
    {
        if (filled($cartLine)) {
            if (is_numeric($cartLine) && is_finite(intval($cartLine))) {
                return $this->cartLines()->where('id', intval($cartLine))->exists();
            }

            if ($cartLine instanceof CartLine) {
                return $this->cartLines()->where('id', $cartLine->id)->exists();
            } else {
                return false;
            }
        }

        return false;
    }

    /**
     * Assign a given cart line
     *
     * @param  App\Models\System\CartLine|int $cartLine
     * @return bool
     * @access public
     */
    public function assignCartLine($cartLine): bool
    {
        if (!$this->hasCartLine($cartLine)) {
            if (is_numeric($cartLine) && is_finite(intval($cartLine))) {
                $cartLine = CartLine::where('id', intval($cartLine))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($cartLine instanceof CartLine) {
                return ($this->cartLines()->save($cartLine)) ? true : false;
            }
        }

        return true;
    }

    /**
     * Unassign a given cart line
     *
     * @param  App\Models\System\CartLine|int $cartLine
     * @return bool
     * @access public
     */
    public function unassignCartLine($cartLine): bool
    {
        if ($this->hasCartLine($cartLine)) {
            if (is_numeric($cartLine) && is_finite(intval($cartLine))) {
                return ($this->cartLines()->detach(intval($cartLine))) ? true : false;
            }

            if ($cartLine instanceof CartLine) {
                return ($this->cartLines()->detach($cartLine->id)) ? true : false;
            }
        }

        return true;
    }
}
