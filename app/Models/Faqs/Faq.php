<?php

namespace App\Models\Faqs;

use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Faqs\Traits\Attribute\FaqAttribute;

class Faq extends Model
{
    use ModelTrait,
        SoftDeletes,
        FaqAttribute {
            // FaqAttribute::getEditButtonAttribute insteadof ModelTrait;
        }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['question', 'answer', 'status'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('access.faqs_table');
    }
}
