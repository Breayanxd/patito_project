<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Branch;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    protected $model = Employee::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'address_id' => Address::factory(),
            'area_or_department' => $this->faker->randomElement(['warehouse','sales','administration']),
            'position' => $this->faker->randomElement(['manager', 'boss', 'director', 'employee','assistant']),
            'branch_id' => Branch::factory(),
            'date_entry' => $this->faker->date(),
            'status' => $this->faker->randomElement(['active','inactive']),
        ];
    }
}
