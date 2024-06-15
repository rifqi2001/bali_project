<?php

namespace App\Http\Controllers\Api;

use App\Models\PaymentConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function confirmPayment(Request $request){
        // $tickets = Ticket::find($request->tickets_id);

        $request->validate([
            'bank_name' => 'required|string',
            'account_number' => 'required|string',
            'account_owner' => 'required|string',
            'nominal' => 'required|string',
            'transfer_date' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = str_replace('public/', '', $image->store('public/images'));

            $paymentConfirmation = PaymentConfirmation::create([
                // 'tickets' => $tickets->id,
                'bank_name' => $request->bank_name,
                'account_number' => $request->account_number,
                'account_owner' => $request->account_owner,
                'nominal' => $request->nominal,
                'transfer_date' => $request->transfer_date,
                'image_path' => $path,
            ]);

            return response()->json(['success' => 'Payment confirmed', 'data' => $paymentConfirmation]);
        }

        return response()->json(['error' => 'Image upload failed'], 400);
    }



    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'bank_name' => 'required|string',
    //         'account_owner' => 'required|string',
    //         'account_number' => 'required|string',
    //         'nominal' => 'required|numeric',
    //         'transfer_date' => 'required|date',
    //         'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);

    //     $path = $request->file('image_path')->store('payment_images');

    //     $payment = new Payment();
    //     $payment->user_id = auth()->id();
    //     $payment->bank_name = $request->bank_name;
    //     $payment->account_owner = $request->account_owner;
    //     $payment->account_number = $request->account_number;
    //     $payment->nominal = $request->nominal;
    //     $payment->transfer_date = $request->transfer_date;
    //     $payment->image_path = $path;
    //     $payment->save();

    //     return response()->json(['message' => 'Payment confirmation successful'], 201);
    // }
}
