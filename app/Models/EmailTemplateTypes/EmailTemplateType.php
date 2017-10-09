<?php

namespace App\Models\EmailTemplateTypes;

use Illuminate\Database\Eloquent\Model;

class EmailTemplateType extends Model
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
        $this->table = config('access.email_template_types_table');
    }
}
