@props([
    'user' => '',
    'country' => '',
    'jobs' => []
])

<div class="relative w-full h-min bg-white rounded-lg shadow-xs hover:shadow-lg transition duration-300 ease-in-out dark:bg-gray-800 dark:shadow-none dark:hover:shadow-none p-8">
    <img 
        src="/fondo_perfil.jpg" 
        alt="Foto de Fondo del Perfil"
        class="absolute top-0 left-0 w-full h-40 min-h-40 sm:h-80 sm:min-h-80 object-cover rounded-t-lg z-10"
    >
    <div class="relative z-20 pt-12 sm:pt-44 space-y-4">
        <img 
            src="https://ui-avatars.com/api/?name={{ $user ? $user->name : auth()->user()->name }}&background=0D8ABC&color=fff&size=512" 
            alt="Imagen de Perfil"
            class="rounded-full w-40 h-40 border-4 border-white dark:border-gray-700 shadow-lg object-cover"
        >
        <div class="w-full grid grid-cols-1 lg:grid-cols-[70%_30%] gap-4">
            <div class="block space-y-1">
                <div class="flex items-end gap-2 flex-wrap">
                    <p class="font-semibold antialiased text-4xl line-clamp-2 leading-12 dark:text-white">
                        {{ $user ? $user->name : auth()->user()->name }}
                    </p>
                    <span 
                        class="p-2 border border-gray-100 rounded-full bg-gray-50 text-xs text-gray-800 font-medium dark:bg-gray-600 dark:border-gray-700 dark:text-gray-50"
                    >
                        Cuenta creada el {{ $user ? $user->created_at : auth()->user()->created_at }}
                    </span>
                </div>
                <small class="text-xl antialiased text-gray-700 line-clamp-1 dark:text-gray-300">{{ $user ? $user->email : auth()->user()->email }}</small>
                <p class="text-base mt-2 text-gray-500 antialiased line-clamp-1 dark:text-gray-500">{{ $country }}</p>
            </div>
            <div class="grid grid-cols-1 gap-3">
                @foreach ($jobs->take(2) as $job)
                    <div class="flex items-center space-x-2">
                        <img 
                            src="{{ $job->company_logo }}" 
                            alt="Imagen de Empresa"
                            class="size-12 shrink-0 rounded-sm"
                        >
                        <h4 class="line-clamp-2 text-lg font-medium text-gray-700 antialiased dark:text-gray-300">
                            {{ $job->company_name }}
                        </h4>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>