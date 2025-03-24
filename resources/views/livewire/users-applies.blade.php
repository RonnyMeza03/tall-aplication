<?php
    use App\Models\UserApply;
    use App\Models\User;
    use App\Models\JobOffer; // Add this import
    use Illuminate\Support\Facades\Auth;
    use Livewire\Volt\Component;
    use Illuminate\Support\Facades\Storage;

    new class extends Component 
    {
        public $jobOffer;
        public $usersApplies = [];

        public function mount()
        {
            $id = request()->route('offer');
            $jobOffer = JobOffer::find($id);
            $this->jobOffer = $jobOffer;
            $this->usersApplies = UserApply::where('job_offer_id', $id)->with('user')->get();
        }

        public function download($path)
        {
            return Storage::disk('public')->download($path);
        }

    }
?>

<div>
   <!-- filepath: c:\Users\RONNY\laravel-projects\tall-aplication\resources\views\livewire\users-applies.blade.php -->
<div style="margin-left: 3%; margin-right: 3%" class="max-w-7xl mx-auto my-8 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4">
        <div>
            <h1 class="text-xl font-bold text-gray-800 dark:text-white">Aplicaciones de Usuarios</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Lista de usuarios que han aplicado a la oferta: 
                <span class="font-semibold">{{$jobOffer->jobTitle}}</span>
            </p>
        </div>
    </div>

    <div class="overflow-x-auto overflow-y-auto max-h-[70vh]">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nombre</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Presentación</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Perfil</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Currículum</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fecha</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($usersApplies as $apply)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{$apply->user->name}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">{{$apply->presentation}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <a href="{{$apply->userUrl}}" class="text-blue-500 hover:underline dark:text-blue-400">Ver perfil</a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <button wire:click="download('{{$apply->pathFile}}')" class="text-blue-500 hover:underline hover:cursor-pointer dark:text-blue-400">{{$apply->nameFile}}</button>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-500 dark:text-gray-400">{{ $apply->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
