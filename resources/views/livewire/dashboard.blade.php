<div>
    <section class="bg-light py-4 mb-4">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container my-5 px-0">
                        <div class="row mx-0 align-items-center">
                            <div class="col-lg-7 px-4">
                                <h1 class="display-5 fw-bold text-dark mb-3">
                                    <span class="text-muted">Tes Kemampuan Akademik untuk </span>
                                    <span class="text-danger">SD, SMP, dan SMA</span>
                                </h1>
                                <p class="lead text-muted mb-4">
                                    Uji kemampuan akademik siswa Indonesia secara daring dengan platform GarudaCerdas.id
                                </p>
                                <button wire:click="startTest" class="btn btn-danger btn-lg px-4">
                                    Mulai Tes
                                </button>
                            </div>
                            <div class="col-lg-5 text-center px-4">
                                <div class="d-inline-flex align-items-center justify-content-center">
                                    <img src="/logo/laptopbird.svg" class="img-fluid" alt="Burung dengan laptop">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item">
                    <div class="container my-5 px-0">
                        <div class="row mx-0 align-items-center">
                            <div class="col-lg-7 px-4">
                                <h1 class="display-5 fw-bold text-dark mb-3">
                                    <span class="text-muted">Siap Hadapi Ujian? </span>
                                    <span class="text-danger">Ayo Latihan Sekarang!</span>
                                </h1>
                                <p class="lead text-muted mb-4">
                                    Persiapkan dirimu untuk ujian sekolah dan masuk perguruan tinggi dengan soal-soal berkualitas.
                                </p>
                                <a href="#" class="btn btn-danger btn-lg px-4">
                                    Lihat Soal
                                </a>
                            </div>
                            <div class="col-lg-5 text-center px-4">
                                <div class="d-inline-flex align-items-center justify-content-center">
                                    <img src="/logo/readingbird.svg" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item">
                    <div class="container my-5 px-0">
                        <div class="row mx-0 align-items-center">
                            <div class="col-lg-7 px-4">
                                <h1 class="display-5 fw-bold text-dark mb-3">
                                    <span class="text-muted">Kenapa GarudaCerdas? </span>
                                    <span class="text-danger">Kunci Suksesmu!</span>
                                </h1>
                                <p class="lead text-muted mb-4">
                                    Kami menyediakan materi terstruktur dan ribuan soal latihan untuk meningkatkan kemampuan akademismu.
                                </p>
                                <a href="#" class="btn btn-danger btn-lg px-4">
                                    Pelajari Lebih Lanjut
                                </a>
                            </div>
                            <div class="col-lg-5 text-center px-4">
                                <div class="d-inline-flex align-items-center justify-content-center">
                                    <div class="placeholder-img">
                                        <img src="/logo/wbird.svg" class="img-fluid ms-auto" alt="Gambar ilustrasi lain">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

           <div class="carousel-indicators d-flex justify-content-center">
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
    </section>

    <!-- Education Levels Section -->
    <section class="py-5">
        <div class="container-fluid px-4">
            <div class="text-center mb-5">
                <h2 class="display-6 fw-bold text-dark">Jenjang Pendidikan</h2>
                <p class="text-muted">Tes TKA tersedia pada GarudaCerdas.id untuk berbagai jenjang pendidikan.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <i class="fas fa-child text-primary" style="font-size: 48px;"></i>
                            </div>
                            <h3 class="h4 fw-bold">SD</h3>
                            <p class="text-muted small">
                                Platform ini menyediakan Tes Kemampuan Akademik yang dirancang khusus untuk peserta didik Sekolah Dasar guna mengukur kemampuan dasar mereka dalam literasi, numerasi, dan logika berpikir.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <i class="fas fa-user-graduate text-success" style="font-size: 48px;"></i>
                            </div>
                            <h3 class="h4 fw-bold">SMP</h3>
                            <p class="text-muted small">
                                GarudaCerdas menghadirkan soal-soal TKA yang disesuaikan dengan kompetensi inti siswa tingkat SMP, mencakup kemampuan analisis, pemahaman bacaan, serta matematika terapan.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <i class="fas fa-graduation-cap text-warning" style="font-size: 48px;"></i>
                            </div>
                            <h3 class="h4 fw-bold">SMA</h3>
                            <p class="text-muted small">
                                Untuk siswa jenjang SMA, kami menyajikan TKA dengan tingkat kesulitan yang lebih tinggi guna mempersiapkan mereka menghadapi seleksi masuk perguruan tinggi maupun asesmen nasional berbasis kompetensi.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Subjects Section -->
    <section class="py-5">
        <div class="container-fluid px-4">
            <div class="text-center mb-5">
                <h2 class="display-6 fw-bold text-dark">Mata Pelajaran</h2>
                <p class="text-muted">
                    Tes TKA mencakup berbagai mata pelajaran inti yang dirancang untuk mengukur kemampuan akademik siswa secara komprehensif sesuai jenjang pendidikan.
                </p>
            </div>

            <div class="text-center">
                <div class="bg-danger rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                    <i class="fas fa-book text-white" style="font-size: 32px;"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- About TKA Section -->
    <section class="py-5 bg-light ">
        <div class="container px-4">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <img src="/logo/readingbird.svg" class="img-fluid ms-auto" alt="Gambar ilustrasi lain">
                </div>
                <div class="col-lg-6">
                    <h2 class="display-6 fw-bold text-dark mb-4">
                        Tentang Tes Kemampuan Akademik
                    </h2>
                    <p class="text-muted mb-4">
                        Tes Kemampuan Akademik (TKA) merupakan evaluasi berbasis digital yang dirancang untuk mengukur tingkat pemahaman, penalaran logis, serta kemampuan numerasi dan literasi siswa di jenjang SD, SMP, dan SMA. Melalui pendekatan yang adaptif dan terstandar, TKA di GarudaCerdas.id membantu peserta memahami kekuatan dan kelemahan akademiknya secara objektif, serta mendukung proses belajar yang lebih terarah.
                    </p>
                    <button wire:click="learnMore" class="btn btn-danger btn-lg">
                        Pelajari Lebih Lanjut
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- School Partners Section -->
    <section class="py-5">
        <div class="container p-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="display-6 fw-bold text-dark mb-4">Mitra Sekolah</h2>
                    <p class="text-muted mb-4">
                        Pencapaian ini kami raih melalui kolaborasi dengan sekolah-sekolah di seluruh Indonesia, serta komitmen kami dalam menyediakan layanan edukasi digital yang unggul dan terpercaya.
                    </p>
                </div>

                <div class="col-lg-6">
                    <div class="row text-center">
                        <div class="col-sm-6 mb-4">
                            <div class="d-flex align-items-center justify-content-center mb-2">
                                <i class="fas fa-school text-primary me-3" style="font-size: 48px;"></i>
                                <div>
                                    <h3 class="h2 fw-bold text-dark mb-0">{{ number_format($schoolPartners ?? 46328) }}</h3>
                                    <p class="text-muted mb-0">Mitra Sekolah</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 mb-4">
                            <div class="d-flex align-items-center justify-content-center mb-2">
                                <i class="fas fa-users text-success me-3" style="font-size: 48px;"></i>
                                <div>
                                    <h3 class="h2 fw-bold text-dark mb-0">{{ number_format($registeredStudents ?? 2245341) }}</h3>
                                    <p class="text-muted mb-0">Siswa telah mendaftar</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- News & Announcements Section -->
    <section class="py-5">
        <div class="container px-5">
            <div class="text-center mb-5">
                <h2 class="display-6 fw-bold text-dark">Berita & Pengumuman</h2>
                <p class="text-muted">
                    GarudaCerdas.id menghadirkan informasi terkini seputar kegiatan, pengumuman penting, serta berbagai wawasan pendidikan untuk siswa, orang tua, dan mitra sekolah.
                </p>
            </div>

            <div class="row g-4">
                @php
                    $newsItems = [
                        [
                            'title' => 'Meningkatkan Efektivitas Tes TKA Bersama Sekolah Mitra',
                            'icon' => 'fas fa-chart-line'
                        ],
                        [
                            'title' => 'Apa Saja Tanggung Jawab Akademik Siswa dan Cara Mengelolanya?',
                            'icon' => 'fas fa-user-check'
                        ],
                        [
                            'title' => 'Transformasi Digital di Dunia Pendidikan: Cerita dari Lapangan',
                            'icon' => 'fas fa-digital-tachograph'
                        ]
                    ];
                @endphp

                @foreach($newsItems as $news)
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center p-4">
                                <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                    <i class="{{ $news['icon'] }} text-white" style="font-size: 32px;"></i>
                                </div>
                                <h5 class="fw-bold mb-3">{{ $news['title'] }}</h5>
                                <button wire:click="readMore('{{ $loop->index }}')" class="btn btn-outline-danger">
                                    Baca Lebih Lanjut
                                    <i class="fas fa-arrow-right ms-1"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Learning Modules Section -->
    <section class="py-5">
        <div class="container px-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="display-6 fw-bold text-dark mb-4">Modul Pembelajaran</h2>
                    <p class="text-muted mb-4">
                        Modul Pembelajaran di GarudaCerdas dirancang untuk membantu siswa memahami materi secara mendalam sesuai kurikulum dan jenjang pendidikan masing-masing. Setiap modul disusun secara sistematis, interaktif, dan dapat diakses kapan saja, sehingga mendukung pembelajaran mandiri maupun terstruktur bersama guru.
                    </p>
                    <button wire:click="exploreModules" class="btn btn-danger btn-lg">
                        Pelajari Selengkapnya
                    </button>
                </div>

                <div class="col-lg-6 text-center">
                    <img src="/logo/wbird.svg" class="img-fluid ms-auto" alt="Gambar ilustrasi lain">
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-light text-white">
        <div class="container-fluid px-4 text-center">
            <h2 class="display-6 fw-bold mb-4">Mulai mendaftar.</h2>
            <button wire:click="register" class="btn btn-primary btn-lg px-5">
                Daftar
            </button>
        </div>
    </section>
</div>
