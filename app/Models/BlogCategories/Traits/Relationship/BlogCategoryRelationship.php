<?php

namespace App\Models\BlogCategories\Traits\Relationship;

use App\Models\Access\User\User;

/**
 * Class BlogCategoryRelationship
 */
trait BlogCategoryRelationship
{

    /**
     * BlogCategories belongs to relationship with state
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by', 'id');
    }
}
