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
        'jobOfferId'
    ];

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_applies');
    }
}
