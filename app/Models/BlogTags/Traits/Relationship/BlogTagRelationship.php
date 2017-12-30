<?php

namespace App\Models\BlogTags\Traits\Relationship;

use App\Models\Access\User\User;

/**
 * Class BlogTagRelationship.
 */
trait BlogTagRelationship
{
    /**
     * BlogTags belongs to relationship with state.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
