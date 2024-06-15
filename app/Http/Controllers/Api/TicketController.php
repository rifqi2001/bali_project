<?php

namespace App\Http\Controllers\Api;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{

    public function index()
    {
        // $tickets = Ticket::where('user_id', Auth::id())->get();
        // return response()->json($tickets);

        $user = Auth::user();
        $tickets = Ticket::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->get();

    return response()->json($tickets, 200);
    }

    public function show($id)
    {
        $ticket = Ticket::where('user_id', Auth::id())->findOrFail($id);
        return response()->json($ticket);
    }

    public function create(Request $request){
        $request->validate([
            'visit_date' => 'required|date',
            'ticket_count' => 'required|integer|min:1|max:10',
            'promo_code' => 'nullable|string',
        ]);

        $user = Auth::user();
        $ticketPrice = 15000;
        $discount = 0;

        if ($request->promo_code) {
            $discount = $this->calculateDiscount($request->promo_code);
        }

        $totalPrice = $request->ticket_count * $ticketPrice * ((100 - $discount) / 100);

        $ticketNumber = $this->generateUniqueTicketNumber();

        // $status = $this->calculateTicketStatus($request->visit_date);
        $status = 'Belum Bayar';

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'visit_date' => $request->visit_date,
            'ticket_count' => $request->ticket_count,
            'promo_code' => $request->promo_code,
            'total_price' => $totalPrice,
            'status' => $status,
            'ticket_number' => $ticketNumber,
        ]);

        return response()->json([
            'message' => 'Ticket booked successfully',
            'total_price' => $totalPrice,
            'ticket_number' => $ticketNumber,
            'status' => $status,
        ], 200);
    }

    private function generateUniqueTicketNumber()
    {
        do {
            $ticketNumber = mt_rand(100000, 999999);
        } while (Ticket::where('ticket_number', $ticketNumber)->exists());

        return $ticketNumber;
    }

    private function calculateDiscount($promoCode)
    {
        return 10;
    }

    public function getTicket($id)
    {
        $ticket = Ticket::find($id);
        if ($ticket) {
            \Log::info('Ticket data:', $ticket->toArray());
            return response()->json($ticket);
        } else {
            return response()->json(['error' => 'Ticket not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:belum bayar,aktif,non-aktif',
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->status = $request->status;
        $ticket->save();

        return response()->json(['message' => 'Status updated successfully!'], 200);
    }

    public function destroy($id)
    {

        $ticket = Ticket::find($id);

        if (!$ticket) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }

        if ($ticket->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $ticket->delete();

        return response()->json(['message' => 'Ticket deleted successfully'], 200);

    }
}
