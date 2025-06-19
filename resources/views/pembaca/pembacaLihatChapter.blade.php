@extends('layout.master') {{-- layout khusus pembaca --}}

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-5">
        <span class="fs-4 text-secondary">Daftar Chapter dari Buku</span><br>
        <span class="display-6 fw-semibold text-dark">"{{ $buku->judul }}"</span>
    </h2>

    @if ($buku->chapters->count())
        <div class="row">
            @foreach ($buku->chapters as $chapter)
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card w-100 h-100 d-flex flex-column">
                        <div class="card-body d-flex flex-column text-center">
                            <h5 class="card-title">
                                Chapter {{ $loop->iteration }}: {{ $chapter->title ?? 'Tanpa Judul' }}
                            </h5>
                            <p class="card-text text-muted">
                                Ditulis pada: {{ $chapter->created_at->format('d M Y') }}
                            </p>
                            <a href="{{ route('pembaca.chapterDetail', $chapter->id) }}" class="btn btn-primary mt-auto">
                                📖 Baca Chapter
                        </a>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center text-muted mt-4">
            <p class="fs-5">Tidak ada chapter untuk buku ini.</p>
        </div>
    @endif

    <a href="{{ route('pembaca.pembacaLihatBuku') }}" class="btn btn-primary mt-3 mb-4">← Kembali</a>
</div>
@endsection
