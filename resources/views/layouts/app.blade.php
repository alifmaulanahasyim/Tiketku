<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Platform pemesanan tiket wisata terpercaya di Indonesia">
    <meta name="keywords" content="tiket wisata, pemesanan online, destinasi wisata Indonesia">
    <title>@yield('title', 'Pemesanan Tiket Wisata - Jelajahi Indonesia')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom Styles -->
    <style>
        :root {
            --primary-color: #4285f4;
            --secondary-color: #34a853;
            --accent-color: #fbbc04;
            --danger-color: #ea4335;
            --dark-color: #202124;
            --light-gray: #f8f9fa;
            --medium-gray: #6c757d;
            --shadow-light: 0 2px 10px rgba(0,0,0,0.1);
            --shadow-medium: 0 4px 20px rgba(0,0,0,0.15);
            --gradient-primary: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            --gradient-accent: linear-gradient(135deg, var(--accent-color), #ff9800);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            color: var(--dark-color);
            line-height: 1.6;
        }

        /* Enhanced Navbar */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: none;
            box-shadow: var(--shadow-light);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
            -webkit-text-fill-color: transparent;
        }

        .navbar-brand i {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-right: 0.5rem;
        }

        /* Navigation Links */
        .navbar-nav .nav-link {
            font-weight: 500;
            color: var(--dark-color);
            margin: 0 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            transition: all 0.3s ease;
            position: relative;
        }

        .navbar-nav .nav-link:hover {
            background: var(--gradient-primary);
            color: white;
            transform: translateY(-2px);
        }

        .navbar-nav .nav-link.active {
            background: var(--gradient-primary);
            color: white;
        }

        /* User Profile Dropdown */
        .navbar-profile {
            position: relative;
        }

        .profile-dropdown {
            background: white;
            border-radius: 15px;
            border: none;
            padding: 0.5rem 1rem;
            box-shadow: var(--shadow-light);
            transition: all 0.3s ease;
        }

        .profile-dropdown:hover {
            box-shadow: var(--shadow-medium);
            transform: translateY(-1px);
        }

        /* Main Content */
        main {
            min-height: calc(100vh - 200px);
            padding: 2rem 0;
        }

        /* Footer */
        .footer-custom {
            background: var(--gradient-primary);
            color: white;
            padding: 3rem 0 1rem;
            margin-top: 4rem;
        }

        .footer-custom h5 {
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .footer-custom ul {
            list-style: none;
            padding: 0;
        }

        .footer-custom ul li {
            margin-bottom: 0.5rem;
        }

        .footer-custom ul li a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-custom ul li a:hover {
            color: white;
            padding-left: 0.5rem;
        }

        .social-links a {
            display: inline-block;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            margin: 0 0.5rem;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background: white;
            color: var(--primary-color);
            transform: translateY(-3px);
        }

        /* Scroll to Top Button */
        .scroll-top {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 50px;
            height: 50px;
            background: var(--gradient-primary);
            border: none;
            border-radius: 50%;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .scroll-top.show {
            opacity: 1;
            visibility: visible;
        }

        .scroll-top:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-medium);
        }

        /* Loading Spinner */
        .page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: white;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }

        .loader-spinner {
            width: 50px;
            height: 50px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.2rem;
            }
            
            main {
                padding: 1rem 0;
            }
            
            .footer-custom {
                padding: 2rem 0 1rem;
                text-align: center;
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--gradient-primary);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-color);
        }

        /* Animation Classes */
        .fade-in {
            animation: fadeIn 0.6s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .slide-in-right {
            animation: slideInRight 0.5s ease-out;
        }

        @keyframes slideInRight {
            from { transform: translateX(100px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        /* Notification Toast */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Page Loader -->
    <div class="page-loader" id="pageLoader">
        <div class="loader-spinner"></div>
    </div>

    <!-- Enhanced Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <i class="fas fa-compass"></i>
Tiketku            </a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('user.menu') }}">
                            <i class="fas fa-home me-1"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.menu') }}#wisataGrid">
                            <i class="fas fa-map-marked-alt me-1"></i> Destinasi
                        </a>
                    </li>
                    <li class="nav-item">
                        @php
                            $lastBillId = session('last_bill_id');
                        @endphp
                        <a class="nav-link" href="{{ $lastBillId ? route('pemesanan.bill', $lastBillId) : route('pemesanan.create') }}">
                            <i class="fas fa-ticket-alt me-1"></i> Pemesanan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#footerCustom">
                            <i class="fas fa-info-circle me-1"></i> Tentang
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#footerCustom">
                            <i class="fas fa-envelope me-1"></i> Kontak
                        </a>
                    </li>
                </ul>
                
                <div class="navbar-nav">
                    <div class="nav-item dropdown navbar-profile">
                        <button class="btn profile-dropdown dropdown-toggle d-flex align-items-center" 
                                data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-2"></i>
                            Akun
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/profile"><i class="fas fa-user me-2"></i> Profil</a></li>
                            <li><a class="dropdown-item" href="/orders"><i class="fas fa-list me-2"></i> Pesanan Saya</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="/logout"><i class="fas fa-sign-out-alt me-2"></i> Keluar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="fade-in">
        @yield('content')
    </main>

    <!-- Enhanced Footer -->
    <footer class="footer-custom" id="footerCustom">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5><i class="fas fa-compass me-2"></i>Tiketku</h5>
                    <p>Platform pemesanan tiket wisata terpercaya untuk menjelajahi keindahan Indonesia dengan mudah dan aman.</p>
                    <div class="social-links mt-3">
                        <a href="#" class="text-white"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Navigasi</h5>
                    <ul>
                        <li><a href="/">Beranda</a></li>
                        <li><a href="/destinasi">Destinasi</a></li>
                        <li><a href="/pemesanan">Pemesanan</a></li>
                        <li><a href="/about">Tentang Kami</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Layanan</h5>
                    <ul>
                        <li><a href="/help">Bantuan</a></li>
                        <li><a href="/faq">FAQ</a></li>
                        <li><a href="/terms">Syarat & Ketentuan</a></li>
                        <li><a href="/privacy">Kebijakan Privasi</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5>Hubungi Kami</h5>
                    <ul>
                        <li><i class="fas fa-map-marker-alt me-2"></i> Jakarta, Indonesia</li>
                        <li><i class="fas fa-phone me-2"></i> +62 812-3456-7890</li>
                        <li><i class="fas fa-envelope me-2"></i> info@Tiketku.com</li>
                        <li><i class="fas fa-clock me-2"></i> 24/7 Customer Support</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4" style="border-color: rgba(255,255,255,0.2);">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">&copy; 2025 Tiketku. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">Made with <i class="fas fa-heart text-danger"></i> in Indonesia</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button class="scroll-top" id="scrollToTop">
        <i class="fas fa-chevron-up"></i>
    </button>

    <!-- Toast Container -->
    <div class="toast-container"></div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Hide page loader
            const loader = document.getElementById('pageLoader');
            setTimeout(() => {
                loader.style.opacity = '0';
                setTimeout(() => {
                    loader.style.display = 'none';
                }, 500);
            }, 1000);

            // Scroll to top functionality
            const scrollToTopBtn = document.getElementById('scrollToTop');
            
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    scrollToTopBtn.classList.add('show');
                } else {
                    scrollToTopBtn.classList.remove('show');
                }
            });

            scrollToTopBtn.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // Navbar scroll effect
            const navbar = document.querySelector('.navbar-custom');
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    navbar.style.background = 'rgba(255, 255, 255, 0.98)';
                    navbar.style.boxShadow = '0 4px 20px rgba(0,0,0,0.1)';
                } else {
                    navbar.style.background = 'rgba(255, 255, 255, 0.95)';
                    navbar.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
                }
            });

            // Add active class to current nav item
            const currentLocation = location.pathname;
            const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
            
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === currentLocation) {
                    link.classList.add('active');
                }
            });

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });

        // Utility function for showing toasts
        function showToast(message, type = 'info') {
            const toastContainer = document.querySelector('.toast-container');
            const toast = document.createElement('div');
            toast.className = `toast align-items-center text-bg-${type} border-0`;
            toast.setAttribute('role', 'alert');
            toast.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            `;
            
            toastContainer.appendChild(toast);
            const bsToast = new bootstrap.Toast(toast);
            bsToast.show();
            
            // Remove toast element after it's hidden
            toast.addEventListener('hidden.bs.toast', () => {
                toast.remove();
            });
        }
    </script>
    
    @stack('scripts')
</body>
</html>