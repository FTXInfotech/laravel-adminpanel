<?php

namespace App\Models\EmailTemplates;

use App\Models\BaseModel;
use App\Models\EmailTemplates\Traits\Attribute\EmailTemplateAttribute;
use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailTemplate extends BaseModel
{
    use ModelTrait,
        SoftDeletes,
        EmailTemplateAttribute {
            // EmailTemplateAttribute::getEditButtonAttribute insteadof ModelTrait;
        }

    protected $guarded = ['id'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('module.email_templates.table');
    }
}
