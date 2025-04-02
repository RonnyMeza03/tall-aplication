<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>


<div class="grid grid-cols-[1fr_auto] gap-1.5">
    <div class="block space-y-2 overflow-hidden">
        <h2 class="text-xl font-semibold antialiased truncate dark:text-white">Cerrar sesión</h2>
        <p class="text-gray-600 tex-base antialiased dark:text-gray-400">
            Haz clic en el botón de cerrar sesión a continuación.
        </p>
    </div>
    <div class="shrink-0">
        <svg wire:click="logout" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-log-out-icon lucide-log-out text-red-600 hover:text-red-400 transition-all duration-300 ease-in-out cursor-pointer size-6">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
            <polyline points="16 17 21 12 16 7" />
            <line x1="21" x2="9" y1="12" y2="12" />
        </svg>
    </div>
</div>