@props([
    'jobs' => []
])

<div class="space-y-6 relative w-full h-min bg-white rounded-lg shadow-xs hover:shadow-lg transition duration-300 ease-in-out dark:bg-gray-800 dark:shadow-none dark:hover:shadow-none p-8">
    <h3 class="text-xl font-semibold dark:text-white">Ofertas de trabajo</h3>

    @forelse ($jobs->take(4) as $job)
        <div class="space-y-4 border-b border-gray-200 pb-6 dark:border-gray-700 last:border-b-0 last:pb-0">
            <div class="overflow-hidden w-full">
                <h5 class="text-lg font-medium text-gray-900 dark:text-gray-200 line-clamp-2">{{ $job->job_title }}</h5>
                <div class="flex items-center gap-2 flex-row flex-wrap">
                    <p class="text-gray-600 font-base line-clamp-1 dark:text-gray-400">{{ $job->country_name }}</p>
                    <span class="bg-gray-100 px-2 py-1.5 text-gray-700 text-xs font-medium rounded-full dark:bg-gray-600 dark:border-gray-700 dark:text-gray-50">
                        {{ $job->job_workingHours }}
                    </span>
                    <span class="bg-gray-100 px-2 py-1.5 text-gray-700 text-xs font-medium rounded-full dark:bg-gray-600 dark:border-gray-700 dark:text-gray-50">
                        Publicado el {{ date_format(date_create($job->job_created_at), 'Y/m/d') }}
                    </span>
                </div>
            </div>
            <div class="">
                <div class="flex items-center justify-between gap-2">
                    <div class="grid grid-cols-[auto_1fr] items-center gap-2 text-gray-600 dark:text-gray-400 text-sm font-medium">
                        <svg 
                            xmlns="http://www.w3.org/2000/svg" 
                            width="24" 
                            height="24" 
                            viewBox="0 0 24 24" 
                            fill="none" 
                            stroke="currentColor" 
                            stroke-width="2" 
                            stroke-linecap="round" 
                            stroke-linejoin="round" 
                            class="lucide lucide-dollar-sign-icon lucide-dollar-sign size-5"
                        >
                            <line x1="12" x2="12" y1="2" y2="22"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                        </svg>
                        <p>{{ $job->job_minSalary }}</p>
                    </div>
                    <span class="w-12 bg-gray-400 h-0.5"></span>
                    <div class="grid grid-cols-[auto_1fr] items-center gap-0.5 text-green-600 text-sm font-medium">
                        <svg 
                            xmlns="http://www.w3.org/2000/svg" 
                            width="24" 
                            height="24" 
                            viewBox="0 0 24 24" 
                            fill="none" 
                            stroke="currentColor" 
                            stroke-width="2" 
                            stroke-linecap="round" 
                            stroke-linejoin="round" 
                            class="lucide lucide-dollar-sign-icon lucide-dollar-sign size-5"
                        >
                            <line x1="12" x2="12" y1="2" y2="22"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                        </svg>
                        <p>{{ $job->job_maxSalary }}</p>
                    </div>
                </div>
            </div>
        </div> 
    @empty
        <div class="flex items-center justify-center w-full h-32 text-gray-500 font-medium">
            No hay ofertas de trabajo disponibles.
        </div>
    @endforelse
</div>