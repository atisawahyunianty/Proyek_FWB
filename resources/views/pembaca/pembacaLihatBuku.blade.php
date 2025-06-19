@extends('layout.master') {{-- layout khusus pembaca --}}

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        @forelse ($books as $item)
            <div class="col-sm-6 col-md-3 mb-4 d-flex">
                <div class="card w-100 h-100 shadow-sm border-0 rounded-4 overflow-hidden d-flex flex-column">

                    {{-- Gambar Sampul --}}
                    @if($item->cover_image)
                        <img src="{{ asset('storage/' . $item->cover_image) }}"
                             alt="{{ $item->judul }}"
                             class="card-img-top"
                             style="height: 280px; object-fit: cover; object-position: center;">
                    @else
                        <img src="https://via.placeholder.com/300x280"
                             alt="No Image"
                             class="card-img-top"
                             style="height: 280px; object-fit: cover;">
                    @endif

                    {{-- Isi Card --}}
                    <div class="card-body d-flex flex-column text-center px-3 py-3">
                        {{-- Judul --}}
                        <h6 class="fw-bold text-primary mb-1" style="font-size: 1rem;">{{ $item->judul }}</h6>

                        {{-- Penulis --}}
                        <p class="mb-1 text-muted small">
                            Penulis:
                            @if ($item->user)
                                <a href="{{ route('pembaca.pembacaByPenulis', ['id' => $item->user->id]) }}"
                                   class="text-decoration-none fw-semibold text-primary">
                                   {{ $item->user->username ?? $item->user->name }}
                                </a>
                            @else
                                <span class="text-muted">Tidak ditemukan</span>
                            @endif
                        </p>

                        {{-- Genre --}}
                        <p class="text-muted small mb-2">
                            Genre:
                            <span class="fw-semibold">{{ $item->genres->pluck('name')->join(', ') ?: '-' }}</span>
                        </p>

                        {{-- Bookmark --}}
                        <form action="{{ route('pembaca.bookmark.store', $item->id) }}" method="POST" class="mb-2">
                            @csrf
                            <button class="btn btn-outline-primary btn-sm w-100 rounded-pill">
                                🔖 Bookmark
                            </button>
                        </form>

                        {{-- Tombol Lihat Chapter --}}
                        <a href="{{ route('pembaca.pembacaLihatChapter', $item->id) }}"
                           class="btn btn-primary btn-sm w-100 rounded-pill mt-auto">
                            📖 Lihat Chapter
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-5">
                <em>Tidak ada buku yang tersedia saat ini.</em>
            </div>
        @endforelse
    </div>

    {{-- Tombol Kembali --}}
    <div class="text-center mt-4">
        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary rounded-pill px-4">
            ← Kembali ke Beranda
        </a>
    </div>
</div>
@endsection
