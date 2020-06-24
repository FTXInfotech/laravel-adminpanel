<?php

namespace App\Models\Traits\Page;

use App\Models\Auth\User;

trait PageRelationships
{
    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
