<?php

use Livewire\Volt\Component;

new class extends Component {

    public $profileUrl = '';

    public function mount()
    {
        $this->profileUrl = 'www.linkedin.com/in/ronny-meza-o124124';
    }

}; ?>

<div x-data="{ profileUrl: '{{ $profileUrl }}', copied: false }" class="grid grid-cols-[1fr_auto] gap-1.5">
    <div class="block space-y-2 overflow-hidden">
        <h2 class="text-xl font-semibold antialiased truncate">URL y perfil público</h2>
        <a href="{{ $profileUrl }}" target="_blank" rel="noopener noreferrer"
            class="text-gray-600 tex-base antialiased underline underline-offset-2 hover:text-gray-900">
            {{ $profileUrl }}
        </a>
    </div>
    <div class="shrink-0">
        <svg x-show="!copied" x-on:click="$clipboard(profileUrl); copied = true; setTimeout(() => copied = false, 2000)"
            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-clipboard-copy-icon lucide-clipboard-copy text-gray-600 hover:text-gray-700 transition-all duration-300 ease-in-out cursor-pointer size-6">
            <rect width="8" height="4" x="8" y="2" rx="1" ry="1" />
            <path d="M8 4H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2" />
            <path d="M16 4h2a2 2 0 0 1 2 2v4" />
            <path d="M21 14H11" />
            <path d="m15 10-4 4 4 4" />
        </svg>
        <span x-show="copied">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-clipboard-check-icon lucide-clipboard-check size-6 text-green-600">
                <rect width="8" height="4" x="8" y="2" rx="1" ry="1" />
                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
                <path d="m9 14 2 2 4-4" />
            </svg>
        </span>
    </div>
</div>