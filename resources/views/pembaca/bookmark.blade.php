@extends('layout.master')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold text-primary">
            <i class="fas fa-bookmark me-2"></i>Daftar Bacaan Saya
        </h2>
        <p class="text-muted">Berikut adalah buku-buku yang telah kamu simpan sebagai bookmark 📚</p>
    </div>

    @if($bookmarks->count())
        <div class="list-group shadow-sm rounded">
            @foreach ($bookmarks as $bookmark)
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-book text-secondary"></i>
                        <span class="fw-semibold">{{ $bookmark->book->judul }}</span>
                    </div>

                    <div class="d-flex gap-2">
                        {{-- Tombol Baca --}}
                        <a href="{{ route('pembaca.pembacaLihatChapter', $bookmark->book->id) }}" class="btn btn-success btn-sm">
                            <i class="fas fa-book-open me-1"></i> Baca
                        </a>

                        {{-- Tombol Hapus --}}
                        <form action="{{ route('pembaca.bookmark.destroy', $bookmark->book->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle me-2"></i>Belum ada bacaan yang dibookmark.
        </div>
    @endif

    <div class="text-center mt-4">
        <a href="{{ route('dashboard') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
        </a>
    </div>
</div>
@endsection
