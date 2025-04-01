<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// Ensure the Perfil class exists in the App\Models namespace
use App\Models\Perfil;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'country_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function perfil()
    {
        return $this->hasOne(Perfil::class);
    }

    // Total de ofertas 1. Auth::user()->company()->jobOffers()->count();
    // Total de usuarios en las ofertas 2. Auth::user()->company()->jobOffers()->users()->count();
    // Total de ofertas que estan por expirar 3. Auth::user()->company()->jobOffers()->where('expires_at', '<=', now()->addDays(7))->count();
    // 4. Grafica de barras para ver el total de solicitudes top en la semana actual en una oferta, limite de 5 ofertas.
    // 5. Listado de ofertas por expirar de forma tabular que muestre: nombre, descripción recortada, total de solicitudes, fecha de expiracion ordenados descendentemente por expiracion. 
    public function company()
    {
        return $this->belongsToMany(Company::class, 'user_company');
    }

    public function applies()
    {
        return $this->hasMany(JobOffer::class, 'user_applies');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
