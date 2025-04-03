<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Country;
use App\Models\JobOffer;
use App\Models\Tag;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Support\Facades\Storage;

use function Livewire\store;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    use WithFileUploads;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Copiar la imagen al almacenamiento público y obtener la ruta
        $logoPath = 'logos/JobFinderLogo.png';
        if (!Storage::disk('public')->exists($logoPath)) {
            Storage::disk('public')->put($logoPath, file_get_contents(public_path('JobFinderLogo.png')));
        }

        return [
            'name' => 'JobFinder INC',
            'email' => fake()->unique()->safeEmail(),
            'logo' => $logoPath, // Guardar la ruta relativa en la base de datos
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

            $topics = [
                // Categorías generales
                "Desarrollo de Software",
                "Diseño y Creatividad",
                "Marketing y Ventas",
                "Finanzas y Contabilidad",
                "Administración y Recursos Humanos",
                "Salud y Medicina",
                "Educación y Formación",
                "Construcción e Ingeniería",
                "Logística y Transporte",
                "Atención al Cliente",
                "Legal y Consultoría",
                "Ciencia e Investigación",
              
                // Específicas para Tecnología
                "Frontend Developer",
                "Backend Developer",
                "Fullstack Developer",
                "DevOps Engineer",
                "Data Scientist",
                "Machine Learning Engineer",
                "UX/UI Designer",
                "QA Tester",
                "Product Manager",
                "Cybersecurity Analyst",
                "Blockchain Developer",
              
                // Marketing y Ventas
                "Digital Marketing",
                "SEO Specialist",
                "Community Manager",
                "Copywriter",
                "Growth Hacker",
                "Sales Representative",
              
                // Administración y Finanzas
                "Reclutador",
                "Asistente Administrativo",
              
                // Otros
                "Chef",
                "Conductor",
                "Profesor",
              ];

              $topicLogos = [
                'Desarrollo de Software' => 'tags_logos/code.png',
                'Diseño y Creatividad' => 'tags_logos/brush.png',
                'Marketing y Ventas' => 'tags_logos/circle-dollar-sign.png',
                'Finanzas y Contabilidad' => 'tags_logos/wallet.png',
                'Administración y Recursos Humanos' => 'tags_logos/person-standing.png',
                'Salud y Medicina' => 'tags_logos/heart-pulse.png',
                'Educación y Formación' => 'tags_logos/book-marked.png',
                'Construcción e Ingeniería' => 'tags_logos/hard-hat.png',
                'Logística y Transporte' => 'tags_logos/warehouse.png',
                'Atención al Cliente' => 'tags_logos/headset.png',
                'Legal y Consultoría' => 'tags_logos/scale.png',
                'Ciencia e Investigación' => 'tags_logos/microscope.png',
                'Frontend Developer' => 'tags_logos/laptop-minimal.png',
                'Backend Developer' => 'tags_logos/server.png',
                'Fullstack Developer' => 'tags_logos/computer.png',
                'DevOps Engineer' => 'tags_logos/workflow.png',
                'Data Scientist' => 'tags_logos/between-horizontal-end.png',
                'Machine Learning Engineer' => 'tags_logos/bot.png',
                'UX/UI Designer' => 'tags_logos/palette.png',
                'QA Tester' => 'tags_logos/bug-play.png',
                'Product Manager' => 'tags_logos/square-chart-gantt.png',
                'Cybersecurity Analyst' => 'tags_logos/shield-half.png',
                'Blockchain Developer' => 'tags_logos/link-2-off.png',
                'Digital Marketing' => 'tags_logos/megaphone.png',
                'SEO Specialist' => 'tags_logos/search.png',
                'Community Manager' => 'tags_logos/user.png',
                'Copywriter' => 'tags_logos/pen.png',
                'Growth Hacker' => 'tags_logos/sword.png',
                'Sales Representative' => 'tags_logos/handshake.png',

                'Reclutador' => 'tags_logos/user-plus.png',
                'Asistente Administrativo' => 'tags_logos/clipboard-pen.png',
                'Chef' => 'tags_logos/chef-hat.png',
                'Conductor' => 'tags_logos/car.png',
                'Profesor' => 'tags_logos/book-type.png',
              ];

            foreach ($topics as $topic) {
                // Verificar si el logo ya existe en el almacenamiento
                if (!Storage::disk('public')->exists($topicLogos[$topic])) {
                    // Si no existe, copiar el logo al almacenamiento público
                    Storage::disk('public')->put($topicLogos[$topic], file_get_contents(public_path($topicLogos[$topic])));
                }
                // Crear la etiqueta en la base de datos
                // y asignar el logo correspondiente
                // Verificar si la etiqueta ya existe
                $existingTag = Tag::where('name', $topic)->first();
                if ($existingTag) {
                    // Si la etiqueta ya existe, continuar con la siguiente iteración
                    continue;
                }
                // Si la etiqueta no existe, crearla
                // y asignar el logo correspondiente
                // Crear la etiqueta en la base de datos
                // y asignar el logo correspondiente
                Tag::create([
                    'name' => $topic,
                    'logo' => $topicLogos[$topic] ?? null, // Asignar el logo si existe
                ]);
            }
            for($i = 0; $i < 20; $i++){
                $offer = JobOffer::factory()
                ->create([
                    'isActive' => true,
                    'jobTitle' => fake()->unique()->jobTitle(),
                    'description' => fake()->text(),
                    'minSalary' => fake()->numberBetween(1000, 5000),
                    'maxSalary' => fake()->numberBetween(5000, 10000),
                    'mode' => fake()->randomElement(['remote', 'on-site', 'hybrid']),
                    'workingHours' => fake()->randomElement(['full-time', 'part-time']),
                    'currency' => fake()->randomElement(['USD', 'EUR', 'GBP']),
                    'expires_at' => fake()->dateTimeBetween('now', '+1 month'),
                    'company_id' => $company->id,
                    'country_id' => $company->country_id,
                    'user_id' => $company->users()->first()->id,
                ]);
                $offer->tags()->attach(
                    Tag::inRandomOrder()->take(3)->pluck('id')->toArray()
                );
            }
        });
    }
}
