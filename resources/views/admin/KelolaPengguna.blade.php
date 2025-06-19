@extends('admin.dashboard')

@section('content')
<div class="container py-5">
    <div class="bg-white shadow rounded-4 p-4">

        {{-- Judul Halaman --}}
        <div class="mb-4">
            <h4 class="fw-bold text-primary mb-0">
                <i class="bi bi-people-fill me-2"></i>Kelola Pengguna
            </h4>
        </div>

        {{-- Notifikasi sukses --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Tabel dengan garis pembatas --}}
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="border-bottom border-light">
                    <tr class="text-muted small text-uppercase">
                        <th class="text-primary py-3">Nama</th>
                        <th class="text-primary py-3">Email</th>
                        <th class="text-primary py-3">Role</th>
                        <th class="text-center text-primary py-3" style="width: 130px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="border-bottom border-light">
                            <td class="fw-semibold py-3">{{ $user->name }}</td>
                            <td class="text-muted py-3">{{ $user->email }}</td>
                            <td class="py-3">
                                <span class="badge rounded-pill px-3 py-2 bg-primary bg-opacity-25 text-white shadow-sm text-capitalize">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="text-center py-3">
                                @if (auth()->id() !== $user->id)
                                    <form action="{{ route('admin.hapusPengguna', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm rounded-pill px-3">
                                            <i class="bi bi-x-circle-fill me-1"></i> Hapus
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted small fst-italic">Tidak bisa hapus diri sendiri</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <em>Belum ada pengguna terdaftar.</em>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Tombol Kembali --}}
        <div class="mt-4 text-end">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-primary px-4 rounded-pill shadow-sm">
                <i class="bi bi-arrow-left-circle me-2"></i>Kembali
            </a>
        </div>
    </div>
</div>
@endsection
