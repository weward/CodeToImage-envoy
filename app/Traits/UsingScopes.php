<?php 

namespace App\Traits;

trait UsingScopes
{
    public function scopeUser($query, $value)
    {
        $query->whereHas('user', function($q) use ($value) {
            $q->where('name', $value);
        });
    }

    public function scopeUserId($query, $value)
    {
        $query->where('user_id', $value);
    }

    public function scopeAfter($query, $value)
    {
        $query->where('created_at', '>', $value);
    }

    public function scopeBefore($query, $value)
    {
        $query->where('created_at', '<', $value);
    }

    public function scopeActive($query)
    {
        $query->where('active', 1);
    }

    public function scopeeInactive($query)
    {
        $query->where('active', 0);
    }

}