<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\UserApply;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class UserProfile extends Component
{
    public $user;
    public $country;
    public $jobs;
    public $profile;

    public function mount()
    {

        $userShowed = request()->route('user');

        if ($userShowed) {
            $this->user = User::where('id', $userShowed)->first();
            $this->country = $this->user->country;
            $this->jobs = UserApply::where('user_applies.user_id', $this->user->id)
                ->join('job_offers', 'user_applies.job_offer_id', '=', 'job_offers.id')
                ->join('companies', 'job_offers.company_id', '=', 'companies.id')
                ->join('countries', 'companies.country_id', '=', 'countries.id')
                ->select([
                    'user_applies.*',
                    'job_offers.jobTitle as job_title',
                    'job_offers.created_at as job_created_at',
                    'job_offers.workingHours as job_workingHours',
                    'job_offers.minSalary as job_minSalary',
                    'job_offers.maxSalary as job_maxSalary',
                    'companies.name as company_name',
                    'companies.logo as company_logo',
                    'countries.name as country_name',
                ])
                ->get();
        } else {
            $this->country = Auth::user()->country;
            $this->jobs = UserApply::where('user_applies.user_id', Auth::id())
                ->join('perfils', 'user_applies.user_id', '=', 'perfils.user_id')
                ->join('job_offers', 'user_applies.job_offer_id', '=', 'job_offers.id')
                ->join('companies', 'job_offers.company_id', '=', 'companies.id')
                ->join('countries', 'companies.country_id', '=', 'countries.id')
                ->select([
                    'user_applies.*',
                    'job_offers.jobTitle as job_title',
                    'job_offers.created_at as job_created_at',
                    'job_offers.workingHours as job_workingHours',
                    'job_offers.minSalary as job_minSalary',
                    'job_offers.maxSalary as job_maxSalary',
                    'companies.name as company_name',
                    'companies.logo as company_logo',
                    'countries.name as country_name',
                ])
                ->get();
        }
    }
    public function render()
    {
        return view('livewire.user-profile');
    }
}
