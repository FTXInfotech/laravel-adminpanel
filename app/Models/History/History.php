<?php

namespace App\Models\History;

use App\Models\BaseModel;
use App\Models\History\Traits\Relationship\HistoryRelationship;

/**
 * Class History
 * package App.
 */
class History extends BaseModel
{
    use HistoryRelationship;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'history';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type_id', 'user_id', 'entity_id', 'icon', 'class', 'text', 'assets'];
}
