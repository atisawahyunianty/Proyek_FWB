@extends('layout.master')

@section('content')
<div class="container py-5">
    <div class="bg-white shadow rounded p-4">
        <h2 class="mb-4 fw-bold text-primary">✏️ Edit Buku</h2>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Form --}}
        <form action="{{ route('penulis.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Judul --}}
            <div class="mb-4">
                <label for="judul" class="form-label fw-semibold">Judul Buku</label>
                <input type="text" name="judul" id="judul" class="form-control form-control-lg rounded-3 shadow-sm"
                    value="{{ old('judul', $buku->judul) }}" required>
            </div>

            {{-- Penulis --}}
            <div class="mb-4">
                <label for="penulis" class="form-label fw-semibold">Penulis</label>
                <input type="text" name="penulis" id="penulis" class="form-control form-control-lg rounded-3 shadow-sm"
                    value="{{ old('penulis', $buku->penulis) }}" required>
            </div>

            {{-- Isi --}}
            <div class="mb-4">
                <label for="isi" class="form-label fw-semibold">Isi Buku</label>
                <textarea name="isi" id="isi" class="form-control rounded-3 shadow-sm" rows="5" required>{{ old('isi', $buku->isi) }}</textarea>
            </div>

            {{-- Genre --}}
            <div class="mb-4">
                <label for="genre" class="form-label fw-semibold">Genre</label>
                <input type="text" name="genre" id="genre" class="form-control form-control-lg rounded-3 shadow-sm"
                    value="{{ old('genre', $buku->genres->pluck('name')->implode(', ')) }}" required>
                <div class="form-text">Pisahkan dengan koma jika lebih dari satu. Contoh: Fantasi, Petualangan</div>
            </div>

            {{-- Chapter --}}
            <div class="mb-4">
                <label for="chapters" class="form-label fw-semibold">Daftar Chapter</label>
                <textarea name="chapters" id="chapters" class="form-control rounded-3 shadow-sm" rows="1">{{ old('chapters', $buku->chapters->pluck('judul')->implode("\n")) }}</textarea>
                <div class="form-text">Ketik satu judul chapter per baris.</div>
            </div>

            {{-- Cover --}}
            <div class="mb-4">
                <label for="cover_image" class="form-label fw-semibold">Cover Buku</label><br>
                @if ($buku->cover_image)
                    <img src="{{ asset('storage/' . $buku->cover_image) }}" width="120" class="mb-3 rounded shadow">
                @endif
                <input type="file" name="cover_image" class="form-control shadow-sm">
                <div class="form-text">Kosongkan jika tidak ingin mengubah cover.</div>
            </div>

            {{-- Tombol --}}
            <div class="d-flex justify-content-between">
                <a href="{{ route('penulis.lihatBuku') }}" class="btn btn-primary">← Kembali</a>
                <button type="submit" class="btn btn-primary px-4">💾 Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
