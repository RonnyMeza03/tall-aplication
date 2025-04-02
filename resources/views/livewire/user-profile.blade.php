<div class="bg-gray-100 dark:bg-gray-900 min-h-screen grid grid-cols-1 justify-items-center">
    <div class="container grid grid-cols-1 lg:grid-cols-[75%_25%] gap-4">
        <div class="space-y-4">
            <x-profile-card :country="$country->name" :jobs="$jobs" />
            <livewire:profile.update-password-form />
            <livewire:profile.delete-user-form />
        </div>
        <div class="space-y-4">
            <div class="bg-white border border-gray-200 rounded-lg p-6 space-y-4 shadow-xs hover:shadow-lg transition duration-300 ease-in-out dark:bg-gray-800 dark:border-gray-700 dark:shadow-none dark:hover:shadow-none">
                <livewire:profile.url-public-profile-card />
                <div class="h-0.5 bg-gray-200"></div>
                <livewire:profile.logout-profile-card />
            </div>
            <x-job-offers-cards :jobs="$jobs" />
        </div>
    </div>
</div>