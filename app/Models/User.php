<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Purchase;
use App\Models\Ticket;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

  protected $fillable = [
    'username',
    'first_name',
    'last_name',
    'email',
    'phone',
    'birth_date',
    'password',
    'is_admin',
    'is_active',
];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birth_date' => 'date',
            'is_admin' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    /**
 * Atributo "name" combinado para compatibilidad.
 */
public function getNameAttribute()
{
    return $this->first_name . ' ' . $this->last_name;
}
}