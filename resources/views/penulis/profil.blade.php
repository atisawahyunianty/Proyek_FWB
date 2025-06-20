@extends('layout.master')

@section('content')
<div class="container py-5 d-flex justify-content-center align-items-start" style="min-height: 80vh;">
    <div class="card shadow-lg rounded-4 px-4 py-5" style="max-width: 600px; width: 100%;">
        
        <!-- Foto Profil -->
        {{-- <div class="text-center mb-4">
            @if ($profil && $profil->profile_photo)
                <img src="{{ asset('storage/' . $profil->profile_photo) }}"
                     class="rounded-circle border border-3 border-primary shadow-sm"
                     width="130"
                     height="130"
                     style="object-fit: cover;"> --}}
            {{-- @else
                <i class="bi bi-person-circle text-primary" style="font-size: 6rem;"></i>
            @endif

            <h3 class="mt-3 mb-1 fw-semibold text-primary">
                {{ $profil->name ?? auth()->user()->name }}
            </h3>
            <p class="text-muted mb-0">{{ auth()->user()->email }}</p>
        </div>

        <hr class="my-4"> --}}

        <!-- Informasi Profil -->
        <div class="px-1">
            <h5 class="mb-3 fw-bold text-dark">Informasi Profil</h5>
            <ul class="list-unstyled">
                <li class="mb-2">
                    <strong>Nama:</strong> {{ $profil->name ?? '-' }}
                </li>
                <li>
                    <strong>Email:</strong> {{ auth()->user()->email }}
                </li>
            </ul>
        </div>

        <!-- Tombol Edit -->
        <div class="mt-4 text-end">
            <a href="{{ route('penulis.editProfil') }}" class="btn btn-outline-primary">
                <i class="bi bi-pencil-square me-2"></i> Edit Profil
            </a>
        </div>
    </div>
    </div>
       <a href="{{ route('dashboard') }}" class="btn btn-secondary">← Kembali</a>
</div>
@endsection
