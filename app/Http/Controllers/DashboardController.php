<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->session()->get('search', $request->input('search', ''));
        $tickets = collect();

        if ($search) {
            // Cari tiket dengan nomor tiket yang sesuai dengan pencarian
            $tickets = Ticket::where('ticket_number', 'LIKE', '%' . $search . '%')->get();
        }

        return view('dashboardAdmin', compact('tickets', 'search'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search', '');
        $request->session()->put('search', $search);

        $tickets = collect();
        if (!empty($search)) {
            // Cari tiket yang aktif dan nomor tiketnya sesuai dengan pencarian
            $tickets = Ticket::where('ticket_number', 'LIKE', '%' . $search . '%')
                ->where('status', 'aktif')
                ->get();
        }

        return view('dashboardAdmin', [
            'tickets' => $tickets,
            'search' => $search
        ]);
    }

    public function updateStatusFromDashboard(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:belum bayar,aktif,nonaktif',
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->status = $request->input('status');
        $ticket->save();

        $search = $request->session()->get('search', $request->input('search', ''));

        return redirect()->route('dashboard.index', ['search' => $search])
            ->with('success', 'Status tiket berhasil diperbarui');
    }

    public function validateTicket(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        // Ubah status menjadi nonaktif
        $ticket->status = 'nonaktif';
        $ticket->save();

        $search = $request->session()->get('search', $request->input('search', ''));

        // Redirect kembali ke halaman dashboard
        return redirect()->route('dashboard.index', ['search' => $search])
            ->with('success', 'Tiket berhasil divalidasi dan dinonaktifkan.');
    }
}
