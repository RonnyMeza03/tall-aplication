<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perfil extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'role'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
