<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School SM</title>
    <link rel="shortcut icon"
        href="{{ Storage::url(\App\Models\Setting::where('key', 'favicon')->first()->value ?? 'img/favicon.png') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        header {
            background: url('header-bg.jpg') no-repeat center center;
            background-size: cover;
        }

        section {
            margin-bottom: 30px;
        }

        .card img {
            height: 200px;
            object-fit: cover;
        }

        h2,
        h3 {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">School SM</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#about">Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#vision-mission">Visi & Misi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#gallery">Galeri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Kontak</a>
                </li>
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/home') }}">Home</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>
    </nav>

    <!-- Header -->
    <header class="bg-primary text-white text-center py-5">
        <div class="container">
            <h1>Selamat Datang di SMA School SM</h1>
            <p class="lead">Tempat belajar, tumbuh dan berkembang</p>
        </div>
    </header>

    <!-- About Section -->
    <section id="about" class="py-5">
        <div class="container">
            <h2 class="text-center">Tentang Kami</h2>
            <p class="text-center">SMA School SM adalah lembaga pendidikan yang berdedikasi untuk membentuk generasi
                muda Indonesia yang berakhlak mulia, berprestasi, dan siap menghadapi tantangan global. Berdiri sejak
                tahun 2000, sekolah kami telah menjadi salah satu sekolah terkemuka di Medan, dengan komitmen kuat untuk
                memberikan pendidikan yang berkualitas dan holistik.</p>
        </div>
    </section>

    <!-- Vision & Mission Section -->
    <section id="vision-mission" class="bg-light py-5">
        <div class="container">
            <h2 class="text-center">Visi & Misi</h2>
            <div class="row">
                <div class="col-md-6">
                    <h3>Visi</h3>
                    <p>"Menjadi sekolah unggulan yang menghasilkan lulusan berakhlak mulia, berprestasi, dan berdaya
                        saing global melalui pendidikan berkualitas dan inovatif."</p>
                </div>
                <div class="col-md-6">
                    <h3>Misi</h3>
                    <ul>
                        <li>Menyediakan fasilitas pembelajaran yang modern dan mendukung proses belajar-mengajar.</li>
                        <li>Menanamkan nilai-nilai moral dan etika melalui berbagai kegiatan keagamaan dan budi pekerti.
                        </li>
                        <li>Menyediakan program bimbingan dan pengayaan untuk meningkatkan prestasi akademik siswa.</li>
                        <li>Mendorong partisipasi siswa dalam berbagai kegiatan ekstrakurikuler untuk mengembangkan
                            bakat dan minat mereka.</li>
                        <li>Menyelenggarakan pelatihan dan workshop untuk meningkatkan kompetensi dan profesionalisme
                            guru.</li>
                        <li>Membangun kemitraan dengan perguruan tinggi, industri, dan lembaga pendidikan lainnya baik
                            di dalam maupun luar negeri.</li>
                        <li>Mempersiapkan siswa untuk dapat bersaing di tingkat nasional maupun internasional melalui
                            penguasaan bahasa asing dan teknologi.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="py-5">
        <div class="container">
            <h2 class="text-center">Galeri</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ URL::to('assets/img/img-01.jpg') }}" class="card-img-top" alt="Gallery Image 1">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ URL::to('assets/img/img-02.jpg') }}" class="card-img-top" alt="Gallery Image 2">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ URL::to('assets/img/img-03.jpg') }}" class="card-img-top" alt="Gallery Image 3">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Add this inside the <body> after the gallery section -->
    <div class="modal fade" id="galleryModal" tabindex="-1" role="dialog" aria-labelledby="galleryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="" class="img-fluid" id="galleryModalImage">
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <section id="contact" class="bg-light py-5">
        <div class="container">
            <h2 class="text-center">Kontak Kami</h2>
            <div class="row">
                <div class="col-md-3">
                    <h3>Alamat</h3>
                    <p>Jl. [Nama Jalan] No. [Nomor], [Nama Kelurahan/Kecamatan], Medan, Sumatera Utara, Indonesia.</p>
                </div>
                <div class="col-md-3">
                    <h3>Email</h3>
                    <p><a href="mailto:info@namasekolah.sch.id">info@namasekolah.sch.id</a></p>
                </div>
                <div class="col-md-3">
                    <h3>Telepon</h3>
                    <p>(061) [Nomor Telepon]</p>
                </div>
                <div class="col-md-3">
                    <h3>Jam Operasional</h3>
                    <p>Senin - Jumat: 07.00 - 16.00 WIB <br>
                        Sabtu: 07.00 - 14.00 WIB <br>
                        Minggu: Tutup</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-primary text-white text-center py-3">
        <div class="container">
            <p>&copy; 2024 School Name. All rights reserved.</p>
        </div>
    </footer>
    <script>
        $(document).ready(function() {
            $('#gallery .card img').on('click', function() {
                var src = $(this).attr('src');
                $('#galleryModalImage').attr('src', src);
                $('#galleryModal').modal('show');
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
