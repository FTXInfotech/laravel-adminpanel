<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //$customer->company
	// customer is belongToMany company
    public function company() {
    	return $this->belongsTo(Company::class);
    }

    protected $guarded = [];
}
