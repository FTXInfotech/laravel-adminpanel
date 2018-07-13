<?php

namespace App\Models\EmailTemplateTypes;

use App\Models\BaseModel;

class EmailTemplateType extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('module.email_templates.types_table');
    }
}
