<?php

namespace App\Models\States;

use App\Models\BaseModel;
use App\Models\States\Traits\Relationship\StateRelationship;

class State extends BaseModel
{
    use StateRelationship;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    public function __construct()
    {
        $this->table = config('access.states_table');
    }
}
