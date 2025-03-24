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
        'curriculumPdf',
        'user_id',
        'jobOffer_id'
    ];

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_applies');
    }

    public function jobOffer()
    {
        return $this->belongsToMany(JobOffer::class, 'user_applies');
    }
}
