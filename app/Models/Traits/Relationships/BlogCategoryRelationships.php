<?php

namespace App\Models\Traits\Relationships;

use App\Models\Auth\User;

trait BlogCategoryRelationships
{
    /**
     * BlogCategories belongs to relationship with user.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * BlogCategories belongs to relationship with user.
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
