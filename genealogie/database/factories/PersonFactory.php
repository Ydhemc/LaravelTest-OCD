<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    protected $model = Person::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'birth_name' => $this->faker->optional()->lastName,
            'middle_names' => $this->faker->optional()->firstName,
            'date_of_birth' => $this->faker->date(),
            'created_by' => \App\Models\User::factory(),

        ];
    }
}
