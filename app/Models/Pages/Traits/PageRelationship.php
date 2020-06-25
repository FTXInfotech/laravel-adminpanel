<?php

namespace App\Models\Pages\Traits;

use App\Models\Auth\User;

trait PageRelationship
{
    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
