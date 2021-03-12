<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

/**
 * Has Translations Relation Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System
 */
trait HasTranslations
{
    /**
     * Gets translations
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function translations()
    {
        return $this->belongsToMany(Translation::class);
    }

    /**
     * Checks if has any translation
     *
     * @return bool
     * @access public
     */
    public function hasTranslations(): bool
    {
        return ($this->translations->count() !== 0) ? true : false;
    }

    /**
     * Determines if has the given translation
     *
     * @param App\Models\System\Translation|int|string $translation
     *
     * @return bool
     * @access public
     */
    public function hasTranslation($translation): bool
    {
        if (filled($translation)) {
            if (is_numeric($translation) && is_finite(intval($translation))) {
                return $this->translations()->where('id', intval($translation))->exists();
            }

            if (is_string($translation)) {
                return $this->translations()->where('name', $translation)->exists();
            }

            if ($translation instanceof Translation) {
                return $this->translations()->where('id', $translation->id)->exists();
            } else {
                return false;
            }
        }

        return false;
    }

    /**
     * Assign the given translation
     *
     * @param App\Models\System\Translation|int|string $translation
     *
     * @return bool
     * @access public
     */
    public function assignTranslation($translation): bool
    {
        if (!$this->hasTranslation($translation)) {
            if (is_numeric($translation) && is_finite(intval($translation))) {
                $translation = Translation::where('id', intval($translation))
                    ->select(['id'])
                    ->findOrFail();
            } elseif (is_string($translation)) {
                $translation = Translation::where('name', $translation)
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($translation instanceof Translation) {
                return ($this->translations()->save($translation)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Assign the given translation
     *
     * @param App\Models\System\Translation|int|string $translation
     *
     * @return bool
     * @access public
     */
    public function unassignTranslation($translation): bool
    {
        if ($this->hasTranslation($translation)) {
            if (is_numeric($translation) && is_finite(intval($translation))) {
                $translation = $this->translations()->where('id', intval($translation))
                    ->select(['id'])
                    ->findOrFail();
            } elseif (is_string($translation)) {
                $translation = $this->translations()->where('name', $translation)
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($translation instanceof Translation) {
                return ($this->translations()->detach($translation->id)) ? true : false;
            }
        }

        return false;
    }
}
