<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Branch>
 */
class BranchFactory extends Factory
{
    protected $model = Branch::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'type' => $this->faker->randomElement(['branch','parent']),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'manager' => $this->faker->name(),
            'status' => $this->faker->randomElement(['active','inactive']),
            'address_id' => Address::factory(),
        ];
    }
}
