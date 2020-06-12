<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $active = 1;
    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    // protected $fillable = ['name', 'email', 'website', 'logo', 'status'];

    protected $guarded = [];

    // company has many customers
    //$company->customers
    public function customers() {
        return $this->hasMany(Customer::class);
    }
}
