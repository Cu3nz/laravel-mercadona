<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //? Aqui es donde vamos a generar los datos aleatorios. 
            'nombre' => ucfirst(fake() -> unique() -> word(3,true)),
            'descripcion' => fake() -> text(),
            'stock' => random_int(1,40)
        ];
    }
}
