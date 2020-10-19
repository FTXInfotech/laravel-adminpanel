<?php

namespace App\Models;

use App\Models\Traits\ModelAttributes;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Attributes\FaqAttributes;

class Faq extends BaseModel
{
    use ModelAttributes, SoftDeletes, FaqAttributes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['question', 'answer', 'status'];
}
