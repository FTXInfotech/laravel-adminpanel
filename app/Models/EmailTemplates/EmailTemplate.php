<?php

namespace App\Models\EmailTemplates;

use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\EmailTemplates\Traits\Attribute\EmailTemplateAttribute;

class EmailTemplate extends Model
{
    use ModelTrait,
        SoftDeletes,
        EmailTemplateAttribute {
            // EmailTemplateAttribute::getEditButtonAttribute insteadof ModelTrait;
        }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('access.email_templates_table');
    }
}
