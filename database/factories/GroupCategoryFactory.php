<?php

namespace Database\Factories;

use App\Models\GroupCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GroupCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' =>  $this->faker->word(),
            'description' => $this->faker->text(),
            'remarks' => "Created by a factory",
        ];
    }
}
