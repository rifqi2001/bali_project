<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'visit_date', 
        'ticket_count', 
        'promo_code', 
        'total_price',
        'status',
        'ticket_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
