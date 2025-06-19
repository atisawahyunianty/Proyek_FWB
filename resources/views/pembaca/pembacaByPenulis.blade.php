@extends('layout.master')

@section('content')
<div class="container mt-5">
    <h2 class="mb-3">
        📚 Buku oleh: 
        <span class="text-primary">
            {{ $penulis->username ?? $penulis->name ?? 'Penulis Tidak Diketahui' }}
        </span>
    </h2>

    @if($books->count())
        <div class="row">
            @foreach($books as $book)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        {{-- Cover Buku --}}
                        @if ($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" 
                                 alt="Cover Buku" 
                                 class="card-img-top rounded-top"
                                 style="height: 200px; object-fit: cover;">
                        @else
                            <img src="https://via.placeholder.com/300x200?text=No+Cover" 
                                 alt="No Cover" 
                                 class="card-img-top rounded-top"
                                 style="height: 200px; object-fit: cover;">
                        @endif

                        <div class="card-body d-flex flex-column text-center">
                            <h5 class="card-title fw-bold text-dark">{{ $book->judul }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($book->isi, 100) }}</p>

                            <a href="{{ route('pembaca.pembacaLihatChapter', $book->id) }}" 
                               class="btn btn-outline-primary btn-sm mt-auto">
                                📖 Lihat Chapter
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info mt-3 text-center">
            <i class="fas fa-info-circle me-1"></i> Penulis ini belum memiliki buku.
        </div>
    @endif

    <div class="text-center">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-4">
            ← Kembali ke Beranda
        </a>
    </div>
</div>
@endsection
