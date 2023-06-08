<?php

namespace Database\Factories;

use App\Models\CodeLanguage;
use App\Traits\factories\StatusableFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CodeLanguage>
 */
class CodeLanguageFactory extends Factory
{
    use StatusableFactory;

    protected $model = CodeLanguage::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = fake()->firstNameFemale();

        // CodeFactory uses ->realData() to get data from seeders

        return [
            'name' => ucwords($name),
            'code' => strtolower($name),
            'active' => 1,
        ];
    }

}
