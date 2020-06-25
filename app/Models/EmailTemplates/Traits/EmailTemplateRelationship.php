<?php

namespace App\Models\EmailTemplates\Traits;

use App\Models\Auth\User;

trait EmailTemplateRelationship
{
    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
