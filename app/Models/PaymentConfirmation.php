<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentConfirmation extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pengguna',
        'tanggal_kunjungan',
        'jumlah_tiket',
        'total_harga_tiket',
        'image_path',
    ];
}
