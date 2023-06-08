<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeLanguage extends Model
{
    use HasFactory;

    protected $table = 'code_languages';

    protected $date = [
        'created_at',
        'updated_at',
    ];

    public function codes()
    {
        return $this->hasMany(Code::class);
    }

    public function scopeLanguage($query, $value)
    {
        $query->where(function ($q) use ($value) {
            $q->where('name', $value);
            $q->orWhere('code', $value);
        });
    }

    public function scopeActive($query)
    {
        $query->where('active', 1);
    }

}
