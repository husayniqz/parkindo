<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parkindo - Sistem Manajemen Perparkiran Modern</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 100px 0;
        }
        .feature-card {
            transition: transform 0.3s ease;
            border: none;
        }
        .feature-card:hover {
            transform: translateY(-10px);
        }
        .icon-box {
            width: 60px;
            height: 60px;
            background-color: #e7f0ff;
            color: #2a5298;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 24px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">
                <i class="fa-solid :fa-square-parking me-2"></i>PARKINDO
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link active me-3" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-3" href="#fitur">Fitur</a>
                    </li>
                    <li class="nav-item">
                        @if (Route::has('login'))
                            @auth
                                @php
                                    // Tentukan rute tujuan dashboard berdasarkan role user yang login
                                    $dashboardRoute = match(Auth::user()->role) {
                                        'admin' => route('admin.dashboard'),
                                        'petugas' => route('petugas.dashboard'),
                                        'owner' => route('owner.dashboard'),
                                        default => '#',
                                    };
                                @endphp
                                <a href="{{ $dashboardRoute }}" class="btn btn-primary btn-sm px-4 rounded-pill">
                                    <i class="fa-solid fa-gauge me-2"></i>Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm px-4 rounded-pill me-2">Masuk</a>
                            @endauth
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-section mt-5">
        <div class="container text-center text-md-start">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <h1 class="display-4 fw-bold mb-3">Kelola Area Parkir Jadi Lebih Mudah & Terpantau</h1>
                    <p class="lead text-white-50 mb-4">Sistem monitoring kendaraan masuk-keluar terintegrasi, laporan pendapatan real-time untuk owner, dan pembagian hak akses petugas yang aman.</p>
                    <div>
                        @auth
                            <a href="{{ $dashboardRoute }}" class="btn btn-warning text-dark fw-bold px-4 py-2 rounded-pill shadow">
                                Kembali ke Dashboard <i class="fa-solid fa-arrow-right ms-2"></i>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-warning text-dark fw-bold px-4 py-2 rounded-pill shadow">
                                Mulai Sekarang <i class="fa-solid fa-arrow-right ms-2"></i>
                            </a>
                        @endauth
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <i class="fa-solid fa-car-tunnel" style="font-size: 200px; opacity: 0.8;"></i>
                </div>
            </div>
        </div>
    </header>

    <section id="fitur" class="py-5 bg-light">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Mengapa Memilih Parkindo?</h2>
                <p class="text-muted">Fitur lengkap yang dirancang khusus untuk efisiensi pengelolaan parkir kendaraan.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 feature-card shadow-sm p-4">
                        <div class="card-body">
                            <div class="icon-box">
                                <i class="fa-solid fa-user-shield"></i>
                            </div>
                            <h5 class="card-title fw-bold mb-3">Multi-Role Access</h5>
                            <p class="card-text text-muted">Akses sistem yang dikelompokkan dengan ketat untuk Admin, Petugas Lapangan, dan Owner demi keamanan data.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 feature-card shadow-sm p-4">
                        <div class="card-body">
                            <div class="icon-box">
                                <i class="fa-solid fa-chart-line"></i>
                            </div>
                            <h5 class="card-title fw-bold mb-3">Laporan Real-Time</h5>
                            <p class="card-text text-muted">Owner dapat memantau grafik omset pendapatan harian dan volume total kendaraan langsung dari dashboard.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 feature-card shadow-sm p-4">
                        <div class="card-body">
                            <div class="icon-box">
                                <i class="fa-solid fa-warehouse"></i>
                            </div>
                            <h5 class="card-title fw-bold mb-3">Manajemen Slot Area</h5>
                            <p class="card-text text-muted">Memantau sisa kapasitas ruang parkir yang tersedia secara dinamis saat kendaraan masuk atau keluar.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white py-4 text-center">
        <div class="container">
            <p class="mb-0 text-white-50">&copy; 2026 Parkindo. Dirancang untuk efisiensi sistem parkir modern modern.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>