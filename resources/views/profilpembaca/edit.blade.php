@extends('layout.master')

@section('content')
<style>
    body {
        background: #faf9f8;
        font-family: 'Poppins', sans-serif;
    }

    .profile-container {
        background: #ffffff;
        max-width: 720px;
        margin: 60px auto;
        padding: 40px 50px;
        border-radius: 24px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
        border: 1px solid #eaeaea;
    }

    .profile-title {
        font-size: 24px;
        font-weight: 600;
        color: #453f3f;
        text-align: center;
        margin-bottom: 30px;
    }

    .profile-image {
        width: 130px;
        height: 130px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #e0d4cc;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
    }

    .form-label {
        font-size: 14px;
        color: #5c5b5b;
        margin-bottom: 5px;
        font-weight: 500;
    }

    .form-control {
        border: 1px solid #dcdcdc;
        background: #fefefe;
        border-radius: 14px;
        padding: 10px 15px;
        font-size: 14px;
        color: #3d3d3d;
    }

    .form-control:focus {
        border-color: #a69cac;
        box-shadow: 0 0 0 0.1rem rgba(166, 156, 172, 0.25);
    }

    .btn-save {
        background-color: #a69cac;
        color: white;
        border-radius: 25px;
        padding: 10px 30px;
        border: none;
        font-weight: 500;
        transition: background 0.3s ease;
    }

    .btn-save:hover {
        background-color: #928793;
    }

    .btn-back {
        border-radius: 25px;
        padding: 10px 25px;
        font-weight: 500;
        border: 1px solid #a69cac;
        background-color: transparent;
        color: #6f6b70;
        transition: all 0.3s ease;
    }

    .btn-back:hover {
        background-color: #f5f3f4;
    }

</style>

<div class="profile-container">
    <h2 class="profile-title">Edit Profil Kamu</h2>

    <div class="text-center">
        @if($profil->profile_photo)
            <img src="{{ asset('storage/' . $profil->profile_photo) }}" class="profile-image">
        @else
            <i class="fas fa-user-circle fa-7x text-muted"></i>
        @endif
    </div>

    <form action="{{ route('profilpembaca.update') }}" method="POST" enctype="multipart/form-data" class="mt-4">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label class="form-label">Foto Profil</label>
            <input type="file" class="form-control" name="profile_photo">
        </div>

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', $profil->name) }}" placeholder="Nama kamu...">
        </div>

        <div class="mb-3">
            <label class="form-label">Bio</label>
            <textarea class="form-control" name="bio" rows="3" placeholder="Tentang dirimu...">{{ old('bio', $profil->bio) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="form-label">Link Sosial Media</label>
            <input type="text" class="form-control" name="social_media_links" value="{{ old('social_media_links', $profil->social_media_links) }}" placeholder="https://instagram.com/kamu">
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('dashboard') }}" class="btn btn-primary">← Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
@endsection
