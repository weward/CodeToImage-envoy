<?php

namespace App\Models;

use App\Traits\UsingScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeStyle extends Model
{
    use HasFactory, UsingScopes;

    protected $table = 'code_styles';

    protected $date = [
        'created_at',
        'updated_at',
    ];

    public function codes()
    {
        return $this->hasMany(Code::class);
    }

    public function scopeStyle($query, $value)
    {
        $query->where(function($q) use ($value) {
            $q->where('name', $value);
            $q->orWhere('code', $value);
        });
    }

}
