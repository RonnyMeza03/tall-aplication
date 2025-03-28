<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Country;
use App\Models\Tag;
use PHPUnit\Framework\Constraint\Count;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'JobFinder INC',
            'email' => fake()->unique()->safeEmail(),
            'logo' => 'https://ui-avatars.com/api/?name=JF&background=0D8ABC&color=fff',
            'website' => fake()->url(),
            'description' => fake()->text(),
            'address' => fake()->address(),
            'country_id' => Country::factory()->create()->id,
        ];
    }

    public function configure(): Factory
    {
        return $this->afterCreating(function (Company $company) {

            $company->users()->attach(
                User::factory()->create([
                    'name' => 'Admin',
                    'email' => 'admin@admin.com',
                    'country_id' => Country::factory()->create()->id,
                    'password' => Hash::make('password'),
                ]),
                ['company_id' => $company->id]
            );

            $topics = ['Ciencia de datos', 
                        'Desarrollo web', 
                        'Desarrollo móvil', 
                        'Ciberseguridad', 
                        'Inteligencia artificial', 
                        'Big data', 
                        'Blockchain', 
                        'Realidad aumentada', 
                        'Realidad virtual', 
                        'Internet de las cosas',
                        'Computación en la nube',
                        'Desarrollo de videojuegos',
                        'Robótica',
                        'administracion de empresas',
                        'marketing',
                        'diseño grafico',
                        'redes sociales',
                        'ventas',
                        'atencion al cliente',
                        'recursos humanos',
                        'contabilidad',
                        'finanzas',
                        'logistica',
                        'mecanica',
                        'electricidad',
                        'electronica',
                        'Architectura',
                        'Ingenieria civil',
                        'Docencia',
                        'Medicina',
                        'Enfermeria',
                        'Mensajeria',
                        'Transporte',
                        'Construccion',
                        'Mantenimiento',];

            foreach ($topics as $topic) {
                Tag::factory()->create(['name' => $topic]);
            }
        });
    }
}
