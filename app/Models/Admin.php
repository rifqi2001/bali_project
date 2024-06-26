<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'super_admin';
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
