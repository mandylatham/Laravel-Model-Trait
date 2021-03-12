<?php

declare(strict_types=1);

namespace App\Models\System\Traits;

use Illuminate\Support\Facades\Storage;
use App\Models\System\Attachment;

/**
 * Has Attachments Relations Trait
 *
 * @copyright 2020 MdRepTime, LLC
 * @package   App\Models\System\Traits
 */
trait HasAttachments
{
    /**
     * Returns all attachments
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @access public
     */
    public function attachments()
    {
        return $this->belongsToMany(Attachment::class);
    }

    /**
     * Checks if has attachments
     *
     * @return bool
     */
    public function hasAttachments(): bool
    {
        return ($this->attachments()->count() !== 0 ) ? true : false;
    }

    /**
     * Determines if has the given attachment
     *
     * @param App\Models\System\Attachment|int $attachment
     *
     * @return bool
     * @access public
     */
    public function hasAttachment($attachment): bool
    {
        if (filled($attachment)) {
            if (is_numeric($attachment) && is_finite(intval($attachment))) {
                return $this->attachments()->where('id', intval($attachment))->exists();
            }

            if ($attachment instanceof Attachment) {
                return $this->attachments()->where('id', $attachment->id)->exists();
            }
        }


        return false;
    }

    /**
     * Assign the given attachment
     *
     * @param App\Models\System\Attachment|int $attachment
     *
     * @return bool
     * @access public
     */
    public function assignAttachment($attachment): bool
    {
        if ($this->hasAttachment($attachment) === false) {
            if (is_numeric($attachment) && is_finite(intval($attachment))) {
                $attachment = Attachment::where('id', intval($attachment))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($attachment instanceof Attachment) {
                return ($this->attachments()->save($attachment)) ? true : false;
            } else {
                return false;
            }
        }

        return true;
    }


    /**
     * Unassign the given attachment
     *
     * @param App\Models\System\Attachment|int $attachment
     *
     * @return bool
     * @access public
     */
    public function unassignAttachment($attachment): bool
    {
        if ($this->hasAttachment($attachment)) {
            if (is_numeric($attachment) && is_finite(intval($attachment))) {
                $attachment = $this->attachments()
                    ->where('id', intval($attachment))
                    ->select(['id'])
                    ->firstOrFail();
            }

            if ($attachment instanceof Attachment) {
                $path = $attachment->path;

                // Delete attachment if possible to save space.
                if (filled($path) && Storage::exists($path)) {
                    Storage::delete($path);
                }

                return ($this->attachments()->detach($attachment->id)) ? true : false;
            }
        }

        return false;
    }
}
