<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'isActive',
        'jobTitle',
        'description',
        'minSalary',
        'maxSalary',
        'mode',
        'workingHours',
        'currency',
        'company_id',
        'country_id',
        'user_id',
        'expiresAt'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_applies');
    }
}
