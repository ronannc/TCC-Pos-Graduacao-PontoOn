<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'salary'           => $this->faker->randomFloat( 2, 1000, 9000  ),
            'name'             => $this->faker->name,
            'mother_name'      => $this->faker->name,
            'email'            => $this->faker->unique()->safeEmail,
            'date_admission'   => $this->faker->date,
            'date_resignation' => null,
            'cpf'              => $this->faker->numerify( "###.###.###-##" ),
            'telephone'        => $this->faker->phoneNumber,
            'time_table_id'    => 1,
            'company_id'       => 1,
            'syndicate_id'     => 1,
        ];
    }
}
