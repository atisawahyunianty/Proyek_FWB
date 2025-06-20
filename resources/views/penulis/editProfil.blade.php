@extends('layout.master')

@section('content')
<div class="container py-5 d-flex justify-content-center align-items-start" style="min-height: 80vh;">
    <div class="card shadow-lg p-4 rounded-4" style="width: 100%; max-width: 600px;">
        <h3 class="mb-4 text-center fw-bold text-primary">Edit Profil</h3>

        {{-- Flash success --}}
         @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('penulis.updateProfil') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH') 

            <!-- Foto Profil Saat Ini -->
            {{-- <div class="mb-4 text-center">
                @if ($profil && $profil->profile_photo)
                    <img src="{{ asset('storage/' . $profil->profile_photo) }}" 
                         alt="Foto Profil" 
                         class="rounded-circle border border-2 border-primary shadow-sm" 
                         width="120" 
                         height="120" 
                         style="object-fit: cover;">
                @else
                    <img src="{{ asset('default/profile.png') }}" 
                         alt="Default Foto" 
                         class="rounded-circle border border-2 border-secondary" 
                         width="120" 
                         height="120" 
                         style="object-fit: cover;">
                @endif
            </div> --}}

            <!-- Input Nama -->
            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Nama</label>
                <input type="text" name="name" class="form-control" value="{{ $profil->name ?? '' }}" required>
            </div> 

            <!-- Input Foto -->
            {{-- <div class="mb-4">
                <label for="foto" class="form-label fw-semibold">Foto Profil</label>
                <input type="file" name="foto" class="form-control">
            </div> --}}

            <!-- Tombol -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">← Kembali</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 
