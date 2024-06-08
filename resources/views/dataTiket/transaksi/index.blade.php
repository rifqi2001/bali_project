@extends('layouts.main')

@section('content')

    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    <div class="page-heading">
        <h3>Transaksi</h3>
    </div> 
    <!-- Bordered table start -->
    <section class="section">
        <div class="row" id="table-bordered">
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Table Data Transaksi Tiket</h4>
                    </div>
                    <div class="card-body">
                        <!-- Table with outer spacing -->
                        <button id="btnTambahPelanggan" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahPelanggan">Tambah Data Transaksi</button>

                        <!-- Modal untuk tambah data pelanggan -->
                        <div class="modal fade" id="modalTambahPelanggan" tabindex="-1" aria-labelledby="modalTambahPelangganLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalTambahPelangganLabel">Tambah Data Pelanggan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{ route('tickets.store') }}">
                                        @csrf
                                        <div class="modal-body">
                                            <!-- Form grup untuk membuat transaksi -->
                                            <div class="mb-3">
                                                <label for="user_id" class="form-label">Nama Pelanggan</label>
                                                <select class="form-select" id="user_id" name="user_id" required>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="visit_date" class="form-label">Tanggal Kunjungan</label>
                                                <input type="date" class="form-control" id="visit_date" name="visit_date" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="ticket_count" class="form-label">Jumlah Tiket</label>
                                                <input type="number" class="form-control" id="ticket_count" name="ticket_count" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="promo_code" class="form-label">Kode Promo</label>
                                                <input type="text" class="form-control" id="promo_code" name="promo_code">
                                            </div>
                                            <div class="mb-3">
                                                <label for="total_price" class="form-label">Total Harga</label>
                                                <input type="number" class="form-control" id="total_price" name="total_price" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select" id="status" name="status" required>
                                                    <option value="belum bayar">Belum Bayar</option>
                                                    <option value="aktif">Aktif</option>
                                                    <option value="nonaktif">Nonaktif</option>
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
                        <div class="table-responsive">
                            <table class="table table-lg">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Tanggal Kunjungan</th>
                                        <th>Jumlah Tiket</th>
                                        <th>Kode Promo</th>
                                        <th>Total Harga</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tickets as $index => $data)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $data->user->name ?? 'Tidak Diketahui' }}</td>
                                            <td>{{ $data->visit_date }}</td>
                                            <td>{{ $data->ticket_count }}</td>
                                            <td>{{ $data->promo_code ?? '-' }}</td>
                                            <td>{{ $data->total_price }}</td>
                                            <td>{{ $data->status }}</td>
                                            <td>
                                                <!-- Tombol aksi untuk mengedit atau menghapus data akun -->
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $data->id }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete{{ $data->id }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>

                                                <!-- Modal Edit -->
                                                <div class="modal fade" id="modalEdit{{ $data->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $data->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalEditLabel{{ $data->id }}">Edit Data Transaksi</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form method="POST" action="{{ route('tickets.update', $data->id) }}">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="status" class="form-label">Status</label>
                                                                        <select class="form-select" id="status" name="status" required>
                                                                            <option value="belum bayar" {{ $data->status == 'belum bayar' ? 'selected' : '' }}>Belum Bayar</option>
                                                                            <option value="aktif" {{ $data->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                                            <option value="nonaktif" {{ $data->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
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

                                                <!-- Modal Delete -->
                                                <div class="modal fade" id="confirmDelete{{ $data->id }}" tabindex="-1" aria-labelledby="confirmDeleteLabel{{ $data->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="confirmDeleteLabel{{ $data->id }}">Konfirmasi Hapus Data</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus data ini?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <form method="POST" action="{{ route('tickets.destroy', $data->id) }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>    
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>                                    
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')

@endsection
