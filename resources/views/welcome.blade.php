<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>HALAMAN UTAMA</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{asset('yummy')}}/assets/img/favicon.png" rel="icon">
  <link href="{{asset('yummy')}}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('yummy')}}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{asset('yummy')}}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{asset('yummy')}}/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="{{asset('yummy')}}/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="{{asset('yummy')}}/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{asset('yummy')}}/assets/css/main.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


  <!-- =======================================================
  * Template Name: Yummy
  * Template URL: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">
<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

        <!-- Kiri: Foto Profil + Logo -->
        <div class="d-flex align-items-center gap-3">
          @auth
          
            @php
                $foto = auth()->user()->profil->profile_photo ?? 'default.png';
            @endphp
            <!-- Foto Profil -->
            <a href="{{ route('profilpembaca.edit') }}">
                <img src="{{ asset('storage/' . $foto) }}" class="rounded-circle" width="40" height="40" style="object-fit: cover;">
            </a>
              
          @endauth
            <!-- Logo WriterHub -->
            <a href="{{ route('home') }}" class="logo d-flex align-items-center">
                <h1 class="sitename mb-0">WriterHub</h1>
            </a>
        </div>

        <!-- Navigasi -->
        <nav id="navmenu" class="navmenu">
            <ul class="navbar d-flex gap-3 align-items-center mb-0 list-unstyled">
                <li><a href="#" class="active nav-link">Beranda</a></li>
                <li><a href="{{ route('pembaca.bookmark') }}" class="nav-link">Bookmark</a></li>
                <li><a href="{{ route('pembaca.pembacaLihatBuku') }}" class="nav-link">Buku</a></li>

                @auth
                    @if(auth()->user()->role === 'penulis')
                        <li>
                            <a href="{{ route('pembaca.pembacaByPenulis', ['id' => auth()->user()->id]) }}" class="nav-link">Penulis</a>
                        </li>
                    @endif
                @endauth
            </ul>
        </nav>

        <!-- Kanan: Auth Button -->
        @if (Route::has('login'))
            @auth
                @if (Auth::user()->role === 'pembaca')
                    <form method="POST" action="{{ route('logout') }}" class="ms-3">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">Logout</button>
                    </form>
                @endif
            @else
                <div class="d-flex ms-3">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm me-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Register</a>
                </div>
            @endauth
        @endif

        <!-- Toggle untuk mobile -->
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </div>
</header>

<main class="main">

  <!-- Hero Section -->
  <section id="hero" class="hero section light-background">
    <div class="container">
      <div class="row gy-4 justify-content-center justify-content-lg-between">
        
        <!-- Kiri: Teks -->
        <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up" style="color: #0d6efd;">Books that Whisper to Your Soul</h1>
          <p data-aos="fade-up" data-aos-delay="100" style="color: #0d6efd;">
            WriterHub is where ideas become books, and stories find their readers
          </p>
          <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
            <!-- Optional button atau action -->
          </div>
        </div>

        <!-- Kanan: Gambar -->
        <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
          <img src="{{ asset('yummy') }}/assets/img/bukusatu.png" class="img-fluid animated" alt="">
        </div>

      </div>
    </div>
  </section>
  <!-- /Hero Section -->

  <!-- Follow Us Section -->
  <div class="col-lg-3 col-md-6 mt-5">
    <h4 style="color: #0d6efd;">Follow Us</h4>
    <div class="social-links d-flex gap-3">
      <a href="#" class="twitter text-primary"><i class="bi bi-twitter-x"></i></a>
      <a href="#" class="facebook text-primary"><i class="bi bi-facebook"></i></a>
      <a href="#" class="instagram text-primary"><i class="bi bi-instagram"></i></a>
      <a href="#" class="linkedin text-primary"><i class="bi bi-linkedin"></i></a>
    </div>
  </div>

  <!-- Footer -->
  <div class="container copyright text-center mt-4">
    <p style="color: #0d6efd;">© <span>Copyright</span> <strong class="px-1 sitename">WriterHub</strong> <span>All Rights Reserved</span></p>
    <div class="credits" style="color: #0d6efd;">
      Designed by <a href="https://bootstrapmade.com/" style="color: #0d6efd;">BootstrapMade</a>
    </div>
  </div>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- Preloader -->
  <div id="preloader"></div>

</main>

  <!-- Vendor JS Files -->
  <script src="{{asset('yummy')}}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset('yummy')}}/assets/vendor/php-email-form/validate.js"></script>
  <script src="{{asset('yummy')}}/assets/vendor/aos/aos.js"></script>
  <script src="{{asset('yummy')}}/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="{{asset('yummy')}}/assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="{{asset('yummy')}}/assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="{{asset('yummy')}}/assets/js/main.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
        const isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};

        document.querySelectorAll('.auth-required').forEach(link => {
            link.addEventListener('click', function (e) {
                if (!isLoggedIn) {
                    e.preventDefault();
                    const lanjut = confirm("Kamu belum login.\nKlik OK untuk Login, atau Cancel untuk Daftar.");
                    if (lanjut) {
                        window.location.href = "{{ route('login') }}";
                    } else {
                        window.location.href = "{{ route('register') }}";
                    }
                }
            });
        });
    });
</script>


</body>

</html>

