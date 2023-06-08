<?php 

namespace App\Traits\tests;

use App\Models\Code;
use App\Models\CodeLanguage;
use App\Models\CodeStyle;

trait GeneratesCodesData 
{
    public function createCodeElements($elements = ['code' => 1, 'codeStyle' => 1, 'codeLanguage' => 1])
    {
        $arr = [];
        foreach ($elements as $key => $value) {
            $arr[$key] = $this->createData($key, $value);
        }

        return $arr;
    }

    public function createCodes($count = 1)
    {
        return Code::factory()->count($count)->create();
    }

    public function createCodeStyles($count = 1)
    {
        return CodeStyle::factory()->count($count)->create();
    }

    public function createCodeLanguages($count = 1)
    {
        return CodeLanguage::factory()->count($count)->create();
    }

    public function createData($element, $count = 1)
    {
        return match($element) {
            'code' => $this->createCodes($count),
            'codeStyle' => $this->createCodeStyles($count),
            'codeLanguage' => $this->createCodeLanguages($count),
        };
    }
}