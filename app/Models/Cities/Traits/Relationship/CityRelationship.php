<?php

namespace App\Models\Cities\Traits\Relationship;

use App\Models\States\State;

/**
 * Class CityRelationship
 */
trait CityRelationship
{

    /**
     * Cities belongs to relationship with state
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
