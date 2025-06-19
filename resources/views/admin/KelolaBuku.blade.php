@extends('admin.dashboard')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg rounded-4 border-0">
        {{-- Header dengan latar biru --}}
        <div class="card-header bg-primary text-white rounded-top-4">
            <h5 class="mb-0 fw-semibold">
                <i class="bi bi-journal-text me-2"></i>Daftar Buku
            </h5>
        </div>

        <div class="card-body bg-light rounded-bottom-4">

            {{-- Notifikasi sukses --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Tabel buku --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle bg-white rounded shadow-sm">
                    <thead class="table-primary text-white">
                        <tr>
                            <th>📘 Judul Buku</th>
                            <th>✍️ Penulis</th>
                            <th class="text-center" style="width: 100px;">🛠️ Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($books as $book)
                            <tr>
                                <td>{{ $book->judul }}</td>
                                <td>{{ $book->user->name }}</td>
                                <td class="text-center">
                                    <form action="{{ route('admin.hapusBuku', $book->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash-fill"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">
                                    <em>Belum ada buku yang terdaftar.</em>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Tombol Kembali --}}
            <div class="mt-4 text-end">
                <a href="{{ route('dashboard') }}" class="btn btn-primary rounded-pill px-4">
                    <i class="bi bi-arrow-left-circle me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
