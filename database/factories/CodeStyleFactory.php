<?php

namespace Database\Factories;

use App\Models\CodeStyle;
use App\Traits\factories\StatusableFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CodeStyle>
 */
class CodeStyleFactory extends Factory
{
    use StatusableFactory;

    protected $model = CodeStyle::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // CodeFactory uses ->realData() to get data from seeders

        $name = fake()->firstNameMale();
        return [
            'name' => ucwords($name),
            'code' => strtolower($name),
            'active' => 1,
        ];
    }
}
