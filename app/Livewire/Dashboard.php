<?php

namespace App\Livewire;

use App\Models\JobOffer;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    public $totalJobOffers = 0;
    public $totalJobOffersUsers = 0;
    public $totalJobOffersByExpiredThisWeek = 0;
    public $jobOffersExpiredThisWeek = [];
    public $barchartData = [];
    public $currentPage = 1;
    public $perPage = 5;
    public $totalPages = 0;

    public function mount()
    {
        $this->totalJobOffers = Auth::user()
            ->company()
            ->join('job_offers', 'companies.id', '=', 'job_offers.company_id')
            ->count('job_offers.id');

        $this->totalJobOffersUsers = Auth::user()
            ->company()
            ->join('job_offers', 'companies.id', '=', 'job_offers.company_id')
            ->join('user_applies', 'job_offers.id', '=', 'user_applies.job_offer_id')
            ->join('users', 'user_applies.user_id', '=', 'users.id')
            ->count('users.id');

        $this->totalJobOffersByExpiredThisWeek = Auth::user()
            ->company()
            ->join('job_offers', 'companies.id', '=', 'job_offers.company_id')
            ->where('job_offers.expires_at', '<=', now()->addDays(7))
            ->count('job_offers.id');
        
        $this->barchartData = $this->loadBarChartData();
        
        $result = $this->getExpiringOffersThisWeek();
        $this->jobOffersExpiredThisWeek = $result['data'];
        $this->currentPage = $result['current_page'];
        $this->totalPages = $result['last_page'];
    }

    public function nextPage()
    {
        if ($this->currentPage < $this->totalPages) {
            $this->currentPage++;
            $this->loadJobs();
        }
    }
    public function previousPage()
    {
        if ($this->currentPage > 1) {
            $this->currentPage--;
            $this->loadJobs();
        }
    }

    public function goToPage($page)
    {
        if ($page > 0 && $page <= $this->totalPages) {
            $this->currentPage = $page;
            $this->loadJobs();
        }
    }

    public function loadJobs()
    {
        $result = $this->getExpiringOffersThisWeek();
        $this->jobOffersExpiredThisWeek = $result['data'];
        $this->currentPage = $result['current_page'];
        $this->totalPages = $result['last_page'];
    }

    private function getExpiringOffersThisWeek()
    {
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();

        $offers = Auth::user()
            ->company()
            ->with('jobOffers.users')
            ->whereHas('jobOffers', function ($query) use ($startOfWeek, $endOfWeek) {
                $query->whereBetween('expires_at', [$startOfWeek, $endOfWeek]);
            })
            ->get()
            ->pluck('jobOffers')
            ->flatten()
            ->map(function ($offer) {
                $offer->total_users_applied = $offer->users->unique('id')->count();
                return $offer;
            });
        
        // Calculate total
        $total = $offers->count();
        
        // Get paginated data
        $items = $offers->forPage($this->currentPage, $this->perPage)->values();
        
        // Set total pages
        $this->totalPages = ceil($total / $this->perPage);
        
        return [
            'data' => $items,
            'current_page' => $this->currentPage,
            'per_page' => $this->perPage,
            'total' => $total,
            'last_page' => $this->totalPages
        ];
    }

    private function loadBarChartData()
    {
        $companyIds = Auth::user()->company()->pluck('companies.id');


        $topJobOffers = JobOffer::whereIn('company_id', $companyIds)
            ->select('job_offers.id', 'job_offers.jobTitle')
            ->selectRaw('(SELECT COUNT(*) FROM user_applies WHERE user_applies.job_offer_id = job_offers.id) as users_count')
            ->orderByDesc('users_count')
            ->take(12)
            ->get();

        $categories = $topJobOffers->pluck('jobTitle')->toArray();
        $usersCount = $topJobOffers->pluck('users_count')->toArray();

        return [
            'categories' => $categories,
            'series' => [
                'name' => 'Solicitudes',
                'data' => $usersCount
            ]
        ];
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
