<?php

namespace App\Models\Auth\Traits\Scopes;

trait UserScopes
{
    /**
     * @param $query
     * @param  bool  $confirmed
     * @return mixed
     */
    public function scopeConfirmed($query, $confirmed = true)
    {
        return $query->where('confirmed', $confirmed);
    }

    /**
     * @param $query
     * @param  bool  $status
     * @return mixed
     */
    public function scopeActive($query, $status = true)
    {
        return $query->where('status', $status);
    }
}
