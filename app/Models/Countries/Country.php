<?php

namespace App\Models\Countries;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    public function __construct()
    {
    	$this->table = config("access.countries_table");
    }
}
