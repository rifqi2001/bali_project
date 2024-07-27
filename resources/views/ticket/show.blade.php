@extends('layouts.main')

@section('content')

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>
<div class="page-heading">
    <h3>Detail Tiket</h3>
</div>

<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Detail Transaksi Tiket</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('tickets.index') }}" class="btn btn-secondary">Kembali ke Transaksi Tiket</a>
                        </div>
                        <div class="col-md-6 text-end">
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $ticket->id }}">Edit Data Tiket</button>
                        </div>
                    </div>

                    <div class="table-responsive mt-4">
                        <table class="table table-bordered">
                            <tr>
                                <th>Nomor Tiket</th>
                                <td>{{ $ticket->ticket_number }}</td>
                            </tr>
                            <tr>
                                <th>Nama Pelanggan</th>
                                <td>{{ $ticket->user->name ?? 'Tidak Diketahui' }}</td>
                            </tr>
                            <tr>
                                <th>Nomor Telepon</th>
                                <td>{{ $ticket->user->phone_number }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Kunjungan</th>
                                <td>{{ $ticket->visit_date }}</td>
                            </tr>
                            <tr>
                                <th>Jumlah Tiket</th>
                                <td>{{ $ticket->ticket_count }}</td>
                            </tr>
                            <tr>
                                <th>Kode Promo</th>
                                <td>{{ $ticket->promo_code ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Total Harga</th>
                                <td>{{ $ticket->total_price }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{ $ticket->status }}</td>
                            </tr>
                        </table>
                    </div>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="modalEdit{{ $ticket->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $ticket->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalEditLabel{{ $ticket->id }}">Edit Data Tiket</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('tickets.update', $ticket->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-select" id="status" name="status" required>
                                                <option value="belum bayar" {{ $ticket->status == 'belum bayar' ? 'selected' : '' }}>Belum Bayar</option>
                                                <option value="aktif" {{ $ticket->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                <option value="nonaktif" {{ $ticket->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection
