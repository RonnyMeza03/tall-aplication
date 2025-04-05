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
                'Desarrollo de Software' => '\icons\code.svg',
                'Diseño y Creatividad' => '\icons\brush.svg',
                'Marketing y Ventas' => '\icons\circle-dollar-sign.svg',
                'Finanzas y Contabilidad' => '\icons\wallet.svg',
                'Administración y Recursos Humanos' => '\icons\person-standing.svg',
                'Salud y Medicina' => '\icons\heart-pulse.svg',
                'Educación y Formación' => '\icons\book-marked.svg',
                'Construcción e Ingeniería' => '\icons\hard-hat.svg',
                'Logística y Transporte' => '\icons\warehouse.svg',
                'Atención al Cliente' => '\icons\headset.svg',
                'Legal y Consultoría' => '\icons\scale.svg',
                'Ciencia e Investigación' => '\icons\microscope.svg',
                'Frontend Developer' => '\icons\laptop-minimal.svg',
                'Backend Developer' => '\icons\server.svg',
                'Fullstack Developer' => '\icons\computer.svg',
                'DevOps Engineer' => '\icons\workflow.svg',
                'Data Scientist' => '\icons\between-horizontal-end.svg',
                'Machine Learning Engineer' => '\icons\bot.svg',
                'UX/UI Designer' => '\icons\palette.svg',
                'QA Tester' => '\icons\bug-play.svg',
                'Product Manager' => '\icons\square-chart-gantt.svg',
                'Cybersecurity Analyst' => '\icons\shield-half.svg',
                'Blockchain Developer' => '\icons\link-2-off.svg',
                'Digital Marketing' => '\icons\megaphone.svg',
                'SEO Specialist' => '\icons\search.svg',
                'Community Manager' => '\icons\user.svg',
                'Copywriter' => '\icons\pen.svg',
                'Growth Hacker' => '\icons\sword.svg',
                'Sales Representative' => '\icons\handshake.svg',
                'Reclutador' => '\icons\user-plus.svg',
                'Asistente Administrativo' => '\icons\clipboard-pen.svg',
                'Chef' => '\icons\chef-hat.svg',
                'Conductor' => '\icons\car.svg',
                'Profesor' => '\icons\book-type.svg',
              ];

            foreach ($topics as $topic) {
                // Verificar si el logo ya existe en el almacenamiento
                if (!Storage::disk('public')->exists($topicLogos[$topic])) {
                    // Si no existe, copiar el logo al almacenamiento público
                    Storage::disk('public')->put($topicLogos[$topic], file_get_contents(public_path($topicLogos[$topic])));
                }
    
                $existingTag = Tag::where('name', $topic)->first();
                if ($existingTag) {
                    continue;
                }
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
