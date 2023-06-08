<?php

namespace Database\Factories;

use App\Models\CodeLanguage;
use App\Models\CodeStyle;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Artisan;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Code>
 */
class CodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $max = 'now';
        $date = fake()->date('Y-m-d', $max);
        $time = fake()->time('H:i:s', $max);
        $dateTime = "{$date} {$time}";


        // Chain ->realData() to use seeders

        return [
            'user_id' => 1,
            'code' => fake()->randomHtml(2, 3),
            'title' => fake()->domainWord(),
            'style_id' => CodeStyle::factory(),
            'language_id' => CodeLanguage::factory(),
            'code_bg' => 'bg-dark',
            'created_at' => $dateTime,
            'updated_at' => $dateTime,
        ];
    }

    /**
     * Indicate that the model's status should be inactive
     */
    public function realData()
    {
        if (! CodeStyle::count()) {
            Artisan::call('db:seed', ['--class'=>'CodeStylesSeeder']);
        }
        if (! CodeLanguage::count()) {
            Artisan::call('db:seed', ['--class'=>'CodeLanguagesSeeder']);
        }

        return $this->state(fn () => [
            'style_id' => CodeStyle::inRandomOrder()->limit(1)->first(),
            'language_id' => CodeLanguage::inRandomOrder()->limit(1)->first(),
        ]);
    }
}
