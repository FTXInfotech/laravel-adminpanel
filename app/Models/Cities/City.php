<?php

namespace App\Models\Cities;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cities\Traits\Relationship\CityRelationship;

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
    	$this->table = config("access.cities_table");
    }
}
