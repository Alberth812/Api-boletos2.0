<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TicketType;
use App\Models\Artist;
use App\Models\Purchase;
use App\Models\Location;
use App\Models\TicketPackage; // ✅ Agregado: relación con paquetes

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_datetime',
        'end_datetime',
        'location_id',
        'status',
        'venue_name',
        'city',
        'country'
    ];

    // Relaciones
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function ticketTypes()
    {
        return $this->hasMany(TicketType::class);
    }

    public function artists()
    {
        return $this->belongsToMany(Artist::class, 'event_artists');
    }

    public function purchases()
    {
        return $this->hasManyThrough(Purchase::class, TicketType::class);
    }

    public function packages()
    {
        return $this->hasMany(TicketPackage::class);
    }
}