<?php

namespace App\Traits;

trait ApproveTrait
{
    public function scopeOfApproved($query)
    {
        $query->where('is_approved', true);
    }

    public function scopeOfBlocked($query)
    {
        $query->where('is_approved', true);
    }
}