<?php

namespace App\Models\Cities;

use App\Models\Cities\Traits\Relationship\CityRelationship;
use App\Models\BaseModel;

class City extends BaseModel
{
    use CityRelationship;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    public function __construct()
    {
        $this->table = config('access.cities_table');
    }
}
