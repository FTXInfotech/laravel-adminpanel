<?php

namespace App\Models\Traits\Relationships;

use App\Models\Auth\User;

trait BlogTagRelationships
{
    /**
     * BlogTags belongs to relationship with user.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
