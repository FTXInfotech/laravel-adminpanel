<?php

namespace App\Models\History;

use App\Models\BaseModel;

/**
 * Class HistoryType
 * package App.
 */
class HistoryType extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'history_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
