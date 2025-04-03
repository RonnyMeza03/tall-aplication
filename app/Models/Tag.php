<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JobOffer;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'logo'];

    public function jobTag()
    {
        return $this->belongsToMany(JobOffer::class, 'job_tag');
    }
}
