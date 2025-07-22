<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'description',
        'discount_type',
        'amount',
        'percentage',
        'valid_from',
        'valid_to',
        'max_uses',
        'used_count',
        'is_active'
    ];

    public function purchases()
    {
        return $this->belongsToMany(Purchase::class, 'purchase_discounts');
    }
}