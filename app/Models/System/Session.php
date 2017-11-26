<?php

namespace App\Models\System;

use App\Models\BaseModel;

/**
 * Class Session
 * package App.
 */
class Session extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sessions';

    /**
     * @var array
     */
    protected $guarded = ['*'];
}
