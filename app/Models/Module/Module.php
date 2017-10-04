<?php

namespace App\Models\Module;

use Illuminate\Database\Eloquent\Model;
use App\Models\Module\Traits\Attribute\ModuleAttribute;

class Module extends Model
{
    use ModuleAttribute;

    protected $table = 'modules';

    protected $fillable = ['view_permission_id', 'name', 'url', 'created_by', 'updated_by'];
}
