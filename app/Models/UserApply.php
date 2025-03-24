<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserApply extends Model
{
    use HasFactory;

    protected $fillable = [
        'presentation',
        'userUrl',
        'nameFile',
        'pathFile',
        'user_id',
        'job_offer_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jobOffer()
    {
        return $this->belongsToMany(JobOffer::class, 'user_applies');
    }
}