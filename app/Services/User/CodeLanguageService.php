<?php 

namespace App\Services\User;

use App\Models\CodeLanguage;

class CodeLanguageService 
{
    public function getcodeLanguages()
    {
        return CodeLanguage::active()->get();
    }
}