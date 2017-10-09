<?php

namespace App\Models\States;

use App\Models\States\Traits\Relationship\StateRelationship;
use Illuminate\Database\Eloquent\Model;

class State extends Model
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
