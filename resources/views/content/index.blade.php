@extends('layouts.main')

@section('content')
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>
<div class="page-heading">
    <h3>Konten Berita</h3>
</div>
<!-- Bordered table start -->
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tabel Data Konten</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Tombol untuk membuka modal create -->
                            <button id="btnTambahKonten" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahKonten">Tambah Konten</button>
                        </div>
                    </div>

                    <!-- Modal untuk tambah data konten -->
                    <div class="modal fade" id="modalTambahKonten" tabindex="-1" aria-labelledby="modalTambahKontenLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTambahKontenLabel">Tambah Konten</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('content.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Judul</label>
                                            <input type="text" class="form-control" id="title" name="title" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="content" class="form-label">Konten</label>
                                            <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Gambar</label>
                                            <input type="file" class="form-control" id="image" name="image">
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

                    <div class="table-responsive mt-2">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Konten</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contents as $index => $content)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $content->title }}</td>
                                        <td>{!! \Illuminate\Support\Str::limit($content->content, 100) !!}</td>
                                        <td>
                                            @if ($content->image)
                                                <img src="{{ asset('storage/' . $content->image) }}" alt="{{ $content->title }}" width="100">
                                            @endif
                                        </td>
                                        <td>
                                            <!-- Tombol aksi untuk mengedit atau menghapus data konten -->
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $content->id }}">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete{{ $content->id }}">
                                                <i class="bi bi-trash"></i>
                                            </button>

                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="modalEdit{{ $content->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $content->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalEditLabel{{ $content->id }}">Edit Konten</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form method="POST" action="{{ route('content.update', $content->id) }}" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="title" class="form-label">Judul</label>
                                                                    <input type="text" class="form-control" id="title" name="title" value="{{ $content->title }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="content" class="form-label">Konten</label>
                                                                    <textarea class="form-control" id="content" name="content" rows="5" required>{{ $content->content }}</textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="image" class="form-label">Gambar</label>
                                                                    <input type="file" class="form-control" id="image" name="image">
                                                                    @if ($content->image)
                                                                        <img src="{{ asset('storage/images/' . $content->image) }}" alt="{{ $content->title }}" width="100">
                                                                    @endif
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
                                            <div class="modal fade" id="confirmDelete{{ $content->id }}" tabindex="-1" aria-labelledby="confirmDeleteLabel{{ $content->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="confirmDeleteLabel{{ $content->id }}">Konfirmasi Hapus Konten</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus konten ini?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                            <form method="POST" action="{{ route('content.destroy', $content->id) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Hapus</button>
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

@section('scripts')
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content');
</script>
@endsection
