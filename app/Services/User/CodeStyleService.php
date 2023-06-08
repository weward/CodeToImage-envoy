<?php

namespace App\Services\User;

use App\Models\CodeStyle;

class CodeStyleService
{
    public function getCodeStyles()
    {
        return CodeStyle::active()->get();
    }

}
