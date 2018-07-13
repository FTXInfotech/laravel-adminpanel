<?php

namespace App\Models\Notification;

use App\Models\BaseModel;

class Notification extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    public function __construct()
    {
        $this->table = config('access.notifications_table');
    }
}
