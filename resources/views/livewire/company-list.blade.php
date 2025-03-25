<div class="max-w-4xl mx-auto mt-6 p-4 bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
    @foreach ($userCompanies as $company)
    <div class="flex items-center p-4 border-b last:border-b-0 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer transition duration-150"
         onclick="window.location.href='{{ route('MyOffers', $company) }}'">
        <div class="w-12 h-12 flex-shrink-0">
            <img src="{{$company->logo}}" alt="Logo de {{$company->name}}" class="w-full h-full rounded-full object-cover">
        </div>
        <div class="ml-4 flex-1">
            <p class="text-gray-900 dark:text-gray-100 font-semibold">{{$company->name}}</p>
            <p class="text-gray-500 dark:text-gray-400 text-sm">{{$company->email}}</p>
        </div>
        <div class="text-right">
            <p class="text-gray-700 dark:text-gray-300 font-medium">{{$company->country->name}}</p>
            <p class="text-gray-500 dark:text-gray-400 text-sm">{{count($company->jobOffers)}} Ofertas</p>
        </div>
    </div>
    @endforeach
</div>
