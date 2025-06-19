@extends('layout.master') {{-- layout khusus pembaca --}}

@section('content')
<div class="container py-5">
    <div class="card shadow-sm rounded-4 border-0 p-4">

        {{-- Judul Chapter --}}
        <div class="mb-3">
            <h2 class="fw-bold text-primary mb-1">{{ $chapter->title }}</h2>
            <p class="text-muted mb-0">
                Dari buku: <strong class="text-dark">{{ $book->judul }}</strong>
            </p>
        </div>

        <hr class="my-4">

        {{-- Isi Chapter --}}
        <div class="mb-4" style="font-size: 1.1rem; line-height: 1.9; text-align: justify;">
            {!! nl2br(e($chapter->content)) !!}
        </div>

        {{-- Tombol Kembali --}}
        <div class="text-end">
            <a href="{{ route('pembaca.pembacaLihatChapter', $book->id) }}" class="btn btn-outline-primary rounded-pill px-4">
                ← Kembali ke Daftar Chapter
            </a>
        </div>
    </div>
</div>
@endsection
