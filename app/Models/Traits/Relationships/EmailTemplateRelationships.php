<?php

namespace App\Models\Traits\Relationships;

use App\Models\Auth\User;

trait EmailTemplateRelationships
{
    /**
     * EmailTemplate belongs to relationship with user.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
