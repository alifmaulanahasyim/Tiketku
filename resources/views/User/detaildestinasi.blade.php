@extends('layouts.app')
@section('content')
<div class="container-fluid px-0">
    <!-- Hero Section with Image -->
    <div class="position-relative">
        <div class="hero-image-container" style="height: 60vh; overflow: hidden;">
            <img src="{{ $destinasi->gambar ? asset('storage/' . $destinasi->gambar) : 'https://via.placeholder.com/1200x600' }}" 
                 class="w-100 h-100 object-fit-cover" 
                 alt="{{ $destinasi->nama_wisata }}"
                 style="object-position: center;">
        </div>
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-25 d-flex align-items-end">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="text-white p-4 mb-4">
                            <h1 class="display-4 fw-bold mb-2">{{ $destinasi->nama_wisata }}</h1>
                            <p class="fs-5 mb-0">
                                <i class="fas fa-map-marker-alt me-2"></i>{{ $destinasi->lokasi }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="container my-5">
        <div class="row g-4">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Description Card -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">
                        <h4 class="card-title mb-3">
                            <i class="fas fa-info-circle text-primary me-2"></i>Deskripsi
                        </h4>
                        <p class="card-text fs-6 lh-base text-muted">{{ $destinasi->deskripsi }}</p>
                    </div>
                </div>

                <!-- Video Section -->
                @if($destinasi->youtube_url)
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">
                        <h4 class="card-title mb-3">
                            <i class="fab fa-youtube text-danger me-2"></i>Video Wisata
                        </h4>
                        <div class="ratio ratio-16x9">
                            <iframe src="https://www.youtube.com/embed/{{ getYoutubeId($destinasi->youtube_url) }}" 
                                    frameborder="0" 
                                    allowfullscreen
                                    class="rounded">
                            </iframe>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Maps Section -->
                @if($destinasi->maps_embed)
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">
                        <h4 class="card-title mb-3">
                            <i class="fas fa-map text-success me-2"></i>Lokasi & Peta
                        </h4>
                        <div class="maps-container rounded overflow-hidden">
                            {!! $destinasi->maps_embed !!}
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Price & Info Card -->
                <div class="card shadow border-0 sticky-top" style="top: 2rem;">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <div class="bg-primary bg-opacity-10 rounded-circle mx-auto mb-3" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-ticket-alt fs-2 text-primary"></i>
                            </div>
                            <h5 class="card-title mb-2">Harga Tiket</h5>
                            <h2 class="text-primary fw-bold mb-0">
                                Rp {{ number_format($destinasi->harga_tiket, 0, ',', '.') }}
                            </h2>
                            <small class="text-muted">per orang</small>
                        </div>

                        <hr class="my-4">

                        <!-- Quick Info -->
                        <div class="mb-4">
                            <h6 class="fw-semibold mb-3">Informasi Singkat</h6>
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-light rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="fas fa-map-marker-alt text-primary"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Lokasi</small>
                                    <span class="fw-medium">{{ $destinasi->lokasi }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="text-center">
                    <a href="{{ route('user.menu') }}" class="btn btn-outline-secondary btn-lg px-4">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Menu
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Custom CSS for enhanced appearance */
.object-fit-cover {
    object-fit: cover;
}

.card {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
}

.maps-container iframe {
    width: 100%;
    height: 300px;
    border: 0;
}

.hero-image-container::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.5) 100%);
}

@media (max-width: 768px) {
    .hero-image-container {
        height: 40vh !important;
    }
    
    .display-4 {
        font-size: 2rem !important;
    }
    
    .sticky-top {
        position: relative !important;
    }
}
</style>
@endsection