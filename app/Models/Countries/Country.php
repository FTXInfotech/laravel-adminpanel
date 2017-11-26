<?php

namespace App\Models\Countries;

use App\Models\BaseModel;

class Country extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    public function __construct()
    {
        $this->table = config('access.countries_table');
    }
}
