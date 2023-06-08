<?php

namespace Database\Seeders;

use App\Models\CodeStyle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CodeStylesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $themes = [
            'amy',
            'ayuLight',
            'atom-one-light',
            'barf',
            'bespin',
            'birdsOfParadise',
            'boysAndGirls',
            'clouds',
            'cobalt',
            'coolGlow',
            'dracula',
            'espresso',
            'noctisLilac',
            'rosePineDawn',
            'smoothy',
            'solarizedLight',
            'tomorrow',
        ];

        $now = now()->format('Y-m-d H:i:s');

        $save = [];
        foreach ($themes as $theme) {
            $save[] =  [
                'name' => ucwords($theme),
                'code' => $theme,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        if (count($save)) {
            CodeStyle::insert($save);
        }

    }
}
