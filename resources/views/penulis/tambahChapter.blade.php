@extends('layout.master')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Tambah Chapter Baru ke: <strong>{{ $book->judul }}</strong></h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('penulis.storeChapter', $book->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Judul Chapter</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Masukkan judul chapter..." required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Isi Chapter</label>
            <textarea class="form-control" id="content" name="content" rows="6" placeholder="Tulis isi chapter di sini..." required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Tambah Chapter</button>
        <a href="{{ route('penulis.lihatBuku') }}" class="btn btn-secondary">← Kembali</a>
    </form>
</div>
@endsection
