<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use App\Models\System\Note;

/**
 * Has Notes Relations Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasNotes
{
    /**
     * Return give note model relationship
     *
         * @copyright 2020 MdRepTime, LLC
     * @return    \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access    public
     */
    public function notes()
    {
        return $this->belongsToMany(Note::class);
    }

    /**
     * Checks if has any assigned notes
     *
     * @return bool
     */
    public function hasNotes(): bool
    {
        return ($this->notes()->count() !== 0) ? true : false;
    }

    /**
     * Determins if has a given note
     *
     * @param  App\Models\System\Note|int $note
     * @return bool
     */
    public function hasNote($note): bool
    {
        if (filled($note)) {
            if (is_numeric($note) && is_finite(intval($note))) {
                return $this->notes()->where('id', intval($note))->exists();
            }

            if ($note instanceof Note) {
                return $this->notes()->where('id', $note->id)->exists();
            }
        }

        return false;
    }

    /**
     * Assign a given note
     *
     * @param  App\Models\System\Note|int $note
     * @return bool
     */
    public function assignNote($note): bool
    {
        if (!$this->hasNote($note)) {
            if (is_numeric($note) && is_finite(intval($note))) {
                $note = Note::where('id', intval($note))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($note instanceof Note) {
                return ($this->notes()->save($note)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Unassign a given note
     *
     * @param  App\Models\System\Note|int $note
     * @return bool
     */
    public function unassignNote($note): bool
    {
        if ($this->hasNote($note)) {
            if (is_numeric($note) && is_finite(intval($note))) {
                $note = $this->notes()->where('id', intval($note))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($note instanceof Note) {
                return ($this->notes()->detach($note->id)) ? true : false;
            }
        }

        return true;
    }
}
