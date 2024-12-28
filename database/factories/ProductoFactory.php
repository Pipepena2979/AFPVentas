<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigo' => $this->faker->unique()->ean13(), // Genera un código EAN-13 único //
            'nombre' => $this->faker->word(), // Genera un nombre de producto aleatorio //
            'descripcion' => $this->faker->sentence(), // Genera una descripción aleatoria //
            'imagen' => $this->faker->imageUrl(640, 480, 'products', true), // Genera una URL de imagen aleatoria //
            'stock' => $this->faker->numberBetween(10, 100), // Genera un stock aleatorio entre 10 y 100 //
            'stock_min' => $this->faker->numberBetween(5, 10), // Genera un stock mínimo aleatorio entre 5 y 10 //
            'stock_max' => $this->faker->numberBetween(50, 200), // Genera un stock máximo aleatorio entre 50 y 200 //
            'precio_compra' => $this->faker->randomFloat(2, 10, 500), // Genera un precio de compra aleatorio entre 10 y 500, con dos decimales //
            'precio_venta' => $this->faker->randomFloat(2, 20, 600), // Genera un precio de venta aleatorio entre 20 y 600, con dos decimales //
            'fecha_ingreso' => $this->faker->date(), // Genera una fecha de ingreso aleatoria //
            'categoria_id' => 4,
            'empresa_id' => 1,
        ];
    }
}
