<?php

namespace App\Http\Controllers\Api;

use App\Models\PaymentConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function confirmPayment(Request $request){
        $request->validate([
            'nama_pengguna' => 'required|string',
            'tanggal_kunjungan' => 'required|string',
            'jumlah_tiket' => 'required|string',
            'total_harga_tiket' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('images', 'public');

            $paymentConfirmation = PaymentConfirmation::create([
                'nama_pengguna' => $request->nama_pengguna,
                'tanggal_kunjungan' => $request->tanggal_kunjungan,
                'jumlah_tiket' => $request->jumlah_tiket,
                'total_harga_tiket' => $request->total_harga_tiket,
                'image_path' => $path,
            ]);

            return response()->json(['success' => 'Payment confirmed', 'data' => $paymentConfirmation]);
        }

        return response()->json(['error' => 'Image upload failed'], 400);
    }
}
