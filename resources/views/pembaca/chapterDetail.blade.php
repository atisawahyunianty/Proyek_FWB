@extends('layout.master') {{-- Ganti jika ada layout khusus pembaca --}}

@section('content')
<div class="container mt-5 mb-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold display-5 text-dark">
            {{ $chapter->title }}
        </h1>
        <p class="text-muted fst-italic">
            Chapter dari buku: <strong>{{ $chapter->book->judul ?? 'Tanpa Judul Buku' }}</strong>
        </p>
        <hr class="w-25 mx-auto mt-3" style="border-top: 2px solid #ccc;">
    </div>

    <div class="p-5 rounded-4 shadow-lg bg-white" style="line-height: 2; font-size: 1.15rem; white-space: pre-line;">
        <p class="mb-0 text-dark">
            {{ $chapter->content }}
        </p>
    </div>

    <div class="text-center mt-5">
        <a href="{{ route('pembaca.pembacaLihatChapter', $chapter->book_id) }}" class="btn btn-outline-primary px-4 py-2 rounded-pill shadow-sm">
            ← Kembali ke Daftar Chapter
        </a>
    </div>
</div>
@endsection
