<?php

namespace App\Models\Cities;

use App\Models\Cities\Traits\Relationship\CityRelationship;
use Illuminate\Database\Eloquent\Model;

class City extends Model
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
