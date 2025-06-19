@extends('layout.master')

@section('content')
<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-book-half me-2"></i>Daftar Buku
        </h2>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach ($books as $book)
            <div class="col">
                <div class="card h-100 shadow-sm border-0 rounded-4">
                    <div class="p-3 pb-0">
                        <img src="{{ asset('storage/' . $book->cover_image) }}"
                             alt="Cover Buku"
                             class="img-fluid rounded-4 border border-secondary-subtle shadow-sm w-100"
                             style="height: 320px; object-fit: cover; background-color: #f8f9fa;">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-semibold text-primary mt-3">{{ $book->judul }}</h5>
                        <p class="text-muted mb-1"><i class="bi bi-person-fill me-1"></i> {{ $book->penulis }}</p>
                        <p class="card-text">{{ Str::limit($book->isi, 100) }}</p>

                        <!-- Genre -->
                        <div class="mb-2">
                            @foreach ($book->genres as $genre)
                                <span class="badge bg-light text-dark border border-primary me-1">{{ $genre->name }}</span>
                            @endforeach
                        </div>

                        <!-- Chapter -->
                        <div class="mb-2">
                            <strong class="d-block text-secondary mb-1">📖 Chapters:</strong>
                            <ul class="ps-3 mb-1 small">
                                @forelse ($book->chapters as $chapter)
                                    <li>{{ $chapter->title }}</li>
                                @empty
                                    <li><em>Belum ada chapter</em></li>
                                @endforelse
                            </ul>
                            <a href="{{ route('penulis.tambahChapter', $book->id) }}" class="btn btn-success btn-sm mt-1">
                                <i class="bi bi-plus-circle"></i> Tambah Chapter
                            </a>
                        </div>

                        <!-- Aksi -->
                        <div class="mt-auto d-flex justify-content-between">
                            <a href="{{ route('penulis.editBuku', $book->id) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>

                            <form action="{{ route('penulis.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Tombol kembali -->
    <div class="text-center mt-5">
        <a href="{{ route('dashboard') }}" class="btn btn-primary px-4 rounded-pill">
            <i class="bi bi-arrow-left-circle me-2"></i>Kembali ke Dashboard
        </a>
    </div>

</div>
@endsection
