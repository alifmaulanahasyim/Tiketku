@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <!-- Hero Section -->
    <div class="hero-section mb-5">
        <div class="text-center">
            <h1 class="display-4 fw-bold text-primary mb-3">
                <i class="fas fa-map-marked-alt me-2"></i>
                Jelajahi Destinasi Wisata
            </h1>
            <p class="lead text-muted">Temukan keindahan alam dan budaya Indonesia dengan mudah</p>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-section mb-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" placeholder="Cari destinasi wisata..." id="searchInput">
                </div>
            </div>
        </div>
    </div>

    <!-- Tourism Objects Grid -->
    <div class="row g-4" id="wisataGrid">
    @foreach($objekWisata as $objek)
    <div class="col-lg-4 col-md-6 mb-4 wisata-card" data-name="{{ strtolower($objek->nama_wisata) }}">
            <div class="card tourism-card h-100 shadow-sm border-0 position-relative overflow-hidden">
                <!-- Image with overlay -->
                <div class="image-container position-relative">
                <img src="{{ $objek->gambar ? asset('storage/' . $objek->gambar) : 'https://via.placeholder.com/400x250/4285f4/ffffff?text=Destinasi+Wisata' }}" 
                    class="card-img-top tourism-img" 
                    loading="lazy">
                    <div class="image-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-end">
                        <div class="overlay-gradient w-100"></div>
                    </div>
                    <!-- Rating Badge -->
                    <div class="position-absolute top-0 end-0 m-3">
                        <span class="badge bg-warning text-dark px-2 py-1 rounded-pill">
                            <i class="fas fa-star"></i> 4.5
                        </span>
                    </div>
                </div>

                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="card-title text-dark fw-bold mb-0">
                            <a href="{{ route('user.destinasi.show', $objek->id) }}" class="text-decoration-none text-dark">
                                {{ $objek->nama_wisata }}
                            </a>
                        </h5>
                        <span class="badge bg-primary-soft text-primary px-2 py-1 rounded-pill small">
                            <i class="fas fa-map-marker-alt"></i> Populer
                        </span>
                    </div>
                    
                    <p class="card-text text-muted mb-3 description-text">
                        {{ Str::limit($objek->deskripsi, 100) }}
                    </p>

                    <!-- Features -->
                    <div class="features mb-3">
                        <small class="text-muted d-flex align-items-center mb-1">
                            <i class="fas fa-clock me-2 text-primary"></i>
                            Buka: 08:00 - 17:00
                        </small>
                        <small class="text-muted d-flex align-items-center">
                            <i class="fas fa-users me-2 text-primary"></i>
                            Cocok untuk keluarga
                        </small>
                    </div>

                    <!-- Price and Button -->
                    <div class="d-flex justify-content-between align-items-center mt-auto">
                        <div class="price-info">
                            <small class="text-muted d-block">Mulai dari</small>
                            <h6 class="text-primary fw-bold mb-0">Rp {{ number_format($objek->harga_tiket,0,',','.') }}</h6>
                        </div>
                        <button class="btn btn-primary btn-pesan px-4 py-2 rounded-pill shadow-sm" 
                                data-id="{{ $objek->id }}"
                                data-nama="{{ $objek->nama_wisata }}">
                            <i class="fas fa-ticket-alt me-2"></i>
                            Pesan Tiket
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Empty State -->
    <div id="emptyState" class="text-center py-5" style="display: none;">
        <i class="fas fa-search fa-3x text-muted mb-3"></i>
        <h5 class="text-muted">Destinasi tidak ditemukan</h5>
        <p class="text-muted">Coba kata kunci yang berbeda</p>
    </div>
</div>

<!-- Enhanced Modal -->
<div class="modal fade" id="modalPemesanan" tabindex="-1" aria-labelledby="modalPemesananLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold" id="modalPemesananLabel">
                    <i class="fas fa-ticket-alt me-2"></i>
                    Pemesanan Tiket Wisata
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0" id="modalPemesananBody">
                <!-- Loading spinner -->
                <div class="text-center py-5" id="loadingSpinner">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="text-muted mt-2">Memuat form pemesanan...</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .hero-section {
        background: linear-gradient(135deg, rgba(66, 133, 244, 0.1) 0%, rgba(66, 133, 244, 0.05) 100%);
        padding: 4rem 0 2rem;
        border-radius: 20px;
        margin-bottom: 3rem;
    }

    .tourism-card {
        transition: all 0.3s ease;
        border-radius: 15px;
        background: #fff;
    }

    .tourism-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1) !important;
    }

    .image-container {
        height: 250px;
        overflow: hidden;
        border-radius: 15px 15px 0 0;
    }

    .tourism-img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .tourism-card:hover .tourism-img {
        transform: scale(1.05);
    }

    .overlay-gradient {
        background: linear-gradient(to top, rgba(0,0,0,0.3) 0%, transparent 50%);
    }

    .btn-pesan {
        background: linear-gradient(45deg, #4285f4, #34a853);
        border: none;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-pesan:hover {
        background: linear-gradient(45deg, #3367d6, #2e8b47);
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(66, 133, 244, 0.3);
    }

    .btn-pesan:before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

    .btn-pesan:hover:before {
        left: 100%;
    }

    .bg-primary-soft {
        background-color: rgba(66, 133, 244, 0.1) !important;
    }

    .description-text {
        line-height: 1.6;
        font-size: 0.9rem;
    }

    .features {
        border-top: 1px solid #f0f0f0;
        padding-top: 1rem;
    }

    .price-info h6 {
        font-size: 1.1rem;
    }

    .filter-section .input-group {
        border-radius: 25px;
        overflow: hidden;
    }

    .filter-section .form-control {
        border: 1px solid #e0e0e0;
        padding: 12px 15px;
    }

    .filter-section .form-control:focus {
        border-color: #4285f4;
        box-shadow: 0 0 0 0.2rem rgba(66, 133, 244, 0.25);
    }

    .modal-content {
        border-radius: 15px;
        overflow: hidden;
    }

    .modal-header {
        background: linear-gradient(45deg, #4285f4, #34a853) !important;
    }

    @media (max-width: 768px) {
        .hero-section {
            padding: 2rem 0 1rem;
        }
        
        .hero-section h1 {
            font-size: 2rem;
        }
        
        .tourism-card:hover {
            transform: none;
        }
    }

    /* Loading animation */
    @keyframes pulse {
        0% { opacity: 1; }
        50% { opacity: 0.5; }
        100% { opacity: 1; }
    }

    .loading {
        animation: pulse 1.5s ease-in-out infinite;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search functionality
        const searchInput = document.getElementById('searchInput');
        const wisataCards = document.querySelectorAll('.wisata-card');
        const emptyState = document.getElementById('emptyState');

        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            let hasResults = false;

            wisataCards.forEach(function(card) {
                const nama = card.getAttribute('data-name');
                if (nama.includes(searchTerm)) {
                    card.style.display = 'block';
                    hasResults = true;
                } else {
                    card.style.display = 'none';
                }
            });

            emptyState.style.display = hasResults ? 'none' : 'block';
        });

        // Enhanced booking button functionality
        document.querySelectorAll('.btn-pesan').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');
                const modal = new bootstrap.Modal(document.getElementById('modalPemesanan'));
                const modalBody = document.getElementById('modalPemesananBody');
                const modalTitle = document.getElementById('modalPemesananLabel');
                
                // Update modal title
                modalTitle.innerHTML = '<i class="fas fa-ticket-alt me-2"></i>Pemesanan Tiket - ' + nama;
                
                // Show loading spinner
                modalBody.innerHTML = `
                    <div class="text-center py-5" id="loadingSpinner">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="text-muted mt-2">Memuat form pemesanan...</p>
                    </div>
                `;
                
                modal.show();

                // Add loading effect to button
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memuat...';
                this.disabled = true;

                // Fetch booking form
                fetch('/pemesanan/form/' + id)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.text();
                    })
                    .then(html => {
                        modalBody.innerHTML = html;
                        // Tambahkan event listener AJAX submit pada form
                        const form = modalBody.querySelector('form');
                        if (form) {
                            form.addEventListener('submit', function(e) {
                                e.preventDefault();
                                const formData = new FormData(form);
                                fetch(form.action, {
                                    method: 'POST',
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest',
                                        'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                                    },
                                    body: formData
                                })
                                .then(response => {
                                    if (response.redirected) {
                                        window.location.href = response.url;
                                    } else {
                                        return response.text().then(text => {
                                            modalBody.innerHTML = text;
                                        });
                                    }
                                })
                                .catch(error => {
                                    modalBody.innerHTML = `<div class='alert alert-danger'>Terjadi kesalahan saat memproses pemesanan.</div>`;
                                });
                            });
                        }
                        // Reset button
                        this.innerHTML = originalText;
                        this.disabled = false;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        modalBody.innerHTML = `
                            <div class="text-center py-5">
                                <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                                <h5 class="text-muted">Gagal memuat form</h5>
                                <p class="text-muted">Terjadi kesalahan saat memuat form pemesanan.</p>
                                <button class="btn btn-primary" onclick="location.reload()">
                                    <i class="fas fa-redo me-2"></i>Coba Lagi
                                </button>
                            </div>
                        `;
                        // Reset button
                        this.innerHTML = originalText;
                        this.disabled = false;
                    });
            });
        });

        // Add smooth scroll animation for cards
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '0';
                    entry.target.style.transform = 'translateY(20px)';
                    
                    setTimeout(() => {
                        entry.target.style.transition = 'all 0.6s ease';
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }, 100);
                }
            });
        });

        wisataCards.forEach((card) => {
            observer.observe(card);
        });
    });
</script>
@endpush