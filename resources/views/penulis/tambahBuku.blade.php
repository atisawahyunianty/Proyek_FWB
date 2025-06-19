@extends('layout.master')

@section('content')
<div class="container py-5">
    <div class="bg-white shadow-lg rounded-4 p-5">
        <h2 class="mb-4 fw-bold text-primary text-center">
            <i class="bi bi-journal-plus me-2"></i> 📚Tambah Buku Baru
        </h2>

        <form action="{{ route('penulis.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Judul Buku -->
            <div class="mb-4">
                <label for="judul" class="form-label fw-semibold text-secondary">Judul Buku</label>
                <input type="text" id="judul" name="judul" class="form-control form-control-lg shadow-sm rounded-3" placeholder="Masukkan judul buku..." required>
            </div>

            <!-- Isi Buku -->
            <div class="mb-4">
                <label for="isi" class="form-label fw-semibold text-secondary">Isi / Deskripsi Buku</label>
                <textarea id="isi" name="isi" class="form-control shadow-sm rounded-3" rows="5" placeholder="Tulis deskripsi atau sinopsis singkat..." required></textarea>
            </div>

            <!-- Penulis -->
            <div class="mb-4">
                <label for="penulis" class="form-label fw-semibold text-secondary">Penulis</label>
                <input type="text" id="penulis" name="penulis" class="form-control form-control-lg shadow-sm rounded-3" placeholder="Nama penulis buku" required>
            </div>

            <!-- Cover -->
            <div class="mb-4">
                <label for="cover_image" class="form-label fw-semibold text-secondary">Gambar Sampul (Cover)</label>
                <input type="file" id="cover_image" name="cover_image" class="form-control shadow-sm rounded-3" accept="image/*" required>
                <div class="form-text">Format gambar: JPG, PNG, atau JPEG.</div>
            </div>

            <!-- Genre -->
            <div class="mb-4">
                <label for="genres" class="form-label fw-semibold text-secondary">Genre</label>
                <input type="text" id="genres" name="genres" class="form-control form-control-lg shadow-sm rounded-3"
                    placeholder="Contoh: Fantasi, Drama, Misteri" required>
                <div class="form-text">Pisahkan setiap genre dengan koma (,).</div>
            </div>

            <!-- Chapters -->
            <div class="mb-4">
                <label class="form-label fw-semibold text-secondary">Chapters</label>
                <div id="chapter-list">
                    <div class="mb-2 row g-2 align-items-center">
                        <div class="col-md-6">
                            <input type="text" name="chapters[0][title]" class="form-control shadow-sm rounded-3" placeholder="Judul Chapter Pertama">
                        </div>
                        <div class="col-md-6">
                            <textarea name="chapters[0][content]" class="form-control shadow-sm rounded-3" rows="2" placeholder="Isi Chapter..."></textarea>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-outline-secondary btn-sm mt-2" onclick="tambahChapter()">
                    <i class="bi bi-plus-circle"></i> Tambah Chapter
                </button>
            </div>

            <!-- Tombol Submit -->
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-lg px-4 shadow">
                    <i class="bi bi-save me-2"></i>Simpan Buku
                </button>
            </div>
        </form>

        <!-- Tombol Kembali -->
        <div class="mt-4 text-center">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left-circle me-2"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>

<!-- Script Chapter Dinamis -->
<script>
let chapterIndex = 1;

function tambahChapter() {
    const container = document.getElementById('chapter-list');
    const row = document.createElement('div');
    row.className = 'mb-2 row g-2 align-items-center';
    row.innerHTML = `
        <div class="col-md-6">
            <input type="text" name="chapters[${chapterIndex}][title]" class="form-control shadow-sm rounded-3" placeholder="Judul Chapter">
        </div>
        <div class="col-md-6">
            <textarea name="chapters[${chapterIndex}][content]" class="form-control shadow-sm rounded-3" rows="2" placeholder="Isi Chapter..."></textarea>
        </div>
    `;
    container.appendChild(row);
    chapterIndex++;
}
</script>
@endsection
