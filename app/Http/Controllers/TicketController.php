<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use App\Models\PaymentConfirmation;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil semua data user dari tabel users
        $tickets = Ticket::orderBy('created_at', 'desc')->get();
        $users = User::all();
        $payments = PaymentConfirmation::all();

        
        // Mengembalikan view akun.index dengan variabel accounts
        return view('dataTiket.transaksi.index', compact('tickets', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    // Fungsi untuk menghasilkan nomor tiket yang unik
    private function generateUniqueTicketNumber()
    {
        do {
            $ticketNumber = mt_rand(100000, 999999);
        } while (Ticket::where('ticket_number', $ticketNumber)->exists());

        return $ticketNumber;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima
    $validatedData = $request->validate([
        'user_id' => 'required|exists:users,id',
        'visit_date' => 'required|date',
        'ticket_count' => 'required|integer',
        'promo_code' => 'nullable|string',
        'total_price' => 'required|numeric',
        'status' => 'required|string',
    ]);


    // Generate nomor tiket unik
    $ticketNumber = $this->generateUniqueTicketNumber();


    // Tambahkan nomor tiket ke data yang akan disimpan
    $validatedData['ticket_number'] = $ticketNumber;

    // Simpan data ke dalam tabel tickets
    Ticket::create($validatedData);

    // Redirect atau response sesuai kebutuhan
    return redirect()->route('tickets.index')->with('success', 'Transaksi tiket berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $ticket = Ticket::findOrFail($id);
        // $paymentConfirmations = PaymentConfirmation::where('ticket_id', $ticket->id)->get();

        // return view('dataTiket.transaksi.detail', compact('ticket', 'paymentConfirmations'));
        $ticket = Ticket::findOrFail($id);
        return view('ticket.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);
    
        $ticket = Ticket::findOrFail($id);
        $ticket->status = $request->input('status');
        $ticket->save();
    
        return redirect()->route('tickets.index')->with('success', 'Status tiket berhasil diupdate.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->status = $request->status;
        $ticket->save();

        return redirect()->route('ticket.show', $id)->with('success', 'Status tiket berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('tickets.index')->with('success', 'Data tiket berhasil dihapus.');
    }

    public function detail($id)
{
    $ticket = Ticket::findOrFail($id);
    $paymentConfirmations = PaymentConfirmation::where('ticket_id', $ticket->id)->get();

    // Mengembalikan view partial yang akan dimuat ke dalam modal
    return view('dataTiket.transaksi.detail', compact('ticket', 'paymentConfirmations'));
}




    
}
