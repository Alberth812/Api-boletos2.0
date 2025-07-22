<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'event_id',
        'max_tickets',
        'is_active'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}