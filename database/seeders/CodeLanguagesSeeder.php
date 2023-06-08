<?php

namespace Database\Seeders;

use App\Models\CodeLanguage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CodeLanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = [
            'angular',
            'css',
            'cpp',
            'html',
            'java',
            'javascript',
            'json',
            'markdown',
            'php',
            'python',
            'rust',
            'sass',
            'vue',
            'xml',
        ];

        $now = now()->format('Y-m-d H:i:s');

        $save = [];
        foreach ($languages as $language) {
            $save[] =  [
                'name' => ucwords($language),
                'code' => $language,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        if (count($save)) {
            CodeLanguage::insert($save);
        }
    }
}
