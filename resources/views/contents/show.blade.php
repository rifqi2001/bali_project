@extends('layouts.main')

@section('content')

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>
<div class="page-heading">
    <h3>Manajemen Konten</h3>
</div> 
<!-- Bordered table start -->
<section class="section">
    <div class="container mt-2">
        <h2>{{ $contents->title }}</h2>
        <p><strong>Created at:</strong> {{ $contents->created_at->format('d M Y') }}</p>
        <img src="{{ ($contents->image) }}" alt="{{ $contents->title }}" class="img-fluid mb-3">
        <p>{{ $contents->content }}</p>
        <a href="{{ route('contents.index') }}" class="btn btn-secondary">Back</a>
    </div>
</section>

@endsection

@section('script')

@endsection

