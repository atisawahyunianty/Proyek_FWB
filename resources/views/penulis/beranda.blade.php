
@extends('penulis.dashboardPenulis') {{-- Ganti ini dari admin.dashboard kalau memang penulis punya sendiri --}}

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Penulis</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #eef1f6, #e0eafc);
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            gap: 20px;
        }

        .box {
            background-color: white;
            padding: 25px 40px;
            border-radius: 20px;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
            text-align: center;
            min-width: 300px;
            animation: fadeIn 0.8s ease-in-out;
        }

        .box h1 {
            margin: 0;
            color: #333;
            font-size: 24px;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            font-size: 16px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease, background-color 0.3s ease;
        }

        .btn:hover {
            transform: scale(1.05);
        }

        .btn-tambah {
            background-color: #4a63f0;
        }

        .btn-tambah:hover {
            background-color: #324ac7;
        }

        .btn-lihat {
            background-color: #1abc9c;
        }

        .btn-lihat:hover {
            background-color: #159d85;
        }

        .btn-kembali {
            background-color: #7f8c8d;
        }

        .btn-kembali:hover {
            background-color: #636e72;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(20px);}
            to {opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body>

    <div class="box">
        <h1>Selamat Datang, Penulis!</h1>
    </div>

    <div class="box">
        <a href="{{ route('penulis.tambahBuku') }}" class="btn btn-primary">Tambah Buku</a>
    </div>

    <div class="box">
        <a href="{{ route('penulis.lihatBuku') }}" class="btn btn-primary">Lihat Buku</a>
    </div>

    <div class="box">
       <a href="{{ route('dashboard') }}" class="btn btn-success">Kembali</a>
    </div>

</body>
</html>


@endsection
