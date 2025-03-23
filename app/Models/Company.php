<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'address',
        'email',
        'logo',
        'website',
        'country_id',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_company', 'company_id', 'user_id');
    }

    public function jobOffers()
    {
        return $this->hasMany(JobOffer::class);
    }
}
