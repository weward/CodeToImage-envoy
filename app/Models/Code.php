<?php

namespace App\Models;

use App\Traits\UsingScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory, UsingScopes;

    protected $table = 'codes';

    protected $date = [
        'created_at',
        'updated_at',
    ];

    public function style()
    {
        return $this->belongsTo(CodeStyle::class);
    }

    public function language()
    {
        return $this->belongsTo(CodeLanguage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeTitle($query, $value)
    {
        $query->where('title', 'like', "%{$value}%");
    }

    public function scopeCode($query, $value)
    {
        $query->where('code', 'like', "%{$value}%");
    }


}
