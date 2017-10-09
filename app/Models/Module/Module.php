<?php

namespace App\Models\Module;

use App\Models\Module\Traits\Attribute\ModuleAttribute;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use ModuleAttribute;

    protected $table = 'modules';

    protected $fillable = ['view_permission_id', 'name', 'url', 'created_by', 'updated_by'];
}
