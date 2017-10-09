<?php

namespace App\Models\States\Traits\Relationship;

use App\Models\Cities\City;
use App\Models\Countries\Country;

/**
 * Class StateRelationship.
 */
trait StateRelationship
{
    /**
     * States belongs to relationship with country.
     */
    public function country()
    {
        return $this->bolongsTo(Country::class);
    }

    /**
     * States has many relationship with cities.
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
