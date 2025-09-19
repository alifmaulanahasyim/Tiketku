
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Admin Panel - Sistem Manajemen Pemesanan Tiket Wisata">
    <title>@yield('title', 'Admin Dashboard') - Tiketku Admin</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    
    <!-- Custom Admin Styles -->
    <style>
        :root {
            --admin-primary: #2563eb;
            --admin-secondary: #64748b;
            --admin-success: #059669;
            --admin-warning: #d97706;
            --admin-danger: #dc2626;
            --admin-info: #0891b2;
            --admin-dark: #1e293b;
            --admin-light: #f8fafc;
            --admin-sidebar-width: 280px;
            --admin-sidebar-collapsed: 80px;
            --admin-header-height: 70px;
            --admin-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --admin-shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--admin-light);
            color: var(--admin-dark);
            font-size: 14px;
            line-height: 1.6;
        }

        /* Sidebar Styles */
        .admin-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--admin-sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, var(--admin-dark) 0%, #0f172a 100%);
            color: white;
            z-index: 1000;
            transition: all 0.3s ease;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .admin-sidebar.collapsed {
            width: var(--admin-sidebar-collapsed);
        }

        .sidebar-header {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            color: white;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .sidebar-logo i {
            font-size: 1.5rem;
            margin-right: 0.75rem;
            color: var(--admin-primary);
        }

        .sidebar-toggle {
            background: none;
            border: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .sidebar-toggle:hover {
            color: var(--admin-primary);
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .nav-item {
            margin: 0.25rem 1rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.875rem 1rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(4px);
        }

        .nav-link.active {
            background: var(--admin-primary);
            color: white;
        }

        .nav-link i {
            width: 20px;
            text-align: center;
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }

        .nav-text {
            transition: opacity 0.3s ease;
        }

        .admin-sidebar.collapsed .nav-text,
        .admin-sidebar.collapsed .sidebar-logo span {
            opacity: 0;
            visibility: hidden;
        }

        .admin-sidebar.collapsed .nav-link {
            justify-content: center;
        }

        .admin-sidebar.collapsed .nav-link i {
            margin-right: 0;
        }

        /* Main Content Styles */
        .admin-main {
            margin-left: var(--admin-sidebar-width);
            transition: margin-left 0.3s ease;
            min-height: 100vh;
        }

        .admin-main.sidebar-collapsed {
            margin-left: var(--admin-sidebar-collapsed);
        }

        /* Header Styles */
        .admin-header {
            background: white;
            height: var(--admin-header-height);
            box-shadow: var(--admin-shadow);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .header-left {
            display: flex;
            align-items: center;
        }

        .breadcrumb-container {
            margin-left: 1rem;
        }

        .breadcrumb {
            background: none;
            padding: 0;
            margin: 0;
        }

        .breadcrumb-item {
            color: var(--admin-secondary);
        }

        .breadcrumb-item.active {
            color: var(--admin-dark);
            font-weight: 600;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .header-notifications {
            position: relative;
            background: none;
            border: none;
            color: var(--admin-secondary);
            font-size: 1.2rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .header-notifications:hover {
            background: var(--admin-light);
            color: var(--admin-primary);
        }

        .notification-badge {
            position: absolute;
            top: 0;
            right: 0;
            width: 18px;
            height: 18px;
            background: var(--admin-danger);
            color: white;
            border-radius: 50%;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .admin-profile:hover {
            background: var(--admin-light);
        }

        .profile-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--admin-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            margin-right: 0.75rem;
        }

        /* Content Styles */
        .admin-content {
            padding: 2rem;
        }

        .page-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--admin-dark);
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stats-card {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: var(--admin-shadow);
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .stats-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--admin-shadow-lg);
        }

        .stats-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .stats-card-icon {
            width: 50px;
            height: 50px;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .stats-card-icon.primary { background: var(--admin-primary); }
        .stats-card-icon.success { background: var(--admin-success); }
        .stats-card-icon.warning { background: var(--admin-warning); }
        .stats-card-icon.info { background: var(--admin-info); }

        .stats-card-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--admin-dark);
            margin-bottom: 0.25rem;
        }

        .stats-card-label {
            color: var(--admin-secondary);
            font-size: 0.875rem;
        }

        .stats-card-change {
            font-size: 0.875rem;
            font-weight: 500;
        }

        .stats-card-change.positive { color: var(--admin-success); }
        .stats-card-change.negative { color: var(--admin-danger); }

        /* Content Cards */
        .content-card {
            background: white;
            border-radius: 1rem;
            box-shadow: var(--admin-shadow);
            border: 1px solid rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .content-card-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: between;
            align-items: center;
        }

        .content-card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--admin-dark);
            margin: 0;
        }

        .content-card-body {
            padding: 2rem;
        }

        /* Buttons */
        .btn-admin {
            border-radius: 0.5rem;
            padding: 0.625rem 1.25rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-admin-primary {
            background: var(--admin-primary);
            color: white;
        }

        .btn-admin-primary:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
            box-shadow: var(--admin-shadow);
        }

        .btn-admin-success {
            background: var(--admin-success);
            color: white;
        }

        .btn-admin-success:hover {
            background: #047857;
            transform: translateY(-1px);
        }

        .btn-admin-warning {
            background: var(--admin-warning);
            color: white;
        }

        .btn-admin-danger {
            background: var(--admin-danger);
            color: white;
        }

        .btn-admin-outline {
            background: transparent;
            border: 1px solid var(--admin-primary);
            color: var(--admin-primary);
        }

        .btn-admin-outline:hover {
            background: var(--admin-primary);
            color: white;
        }

        /* Tables */
        .admin-table {
            width: 100%;
        }

        .admin-table th {
            background: var(--admin-light);
            border: none;
            padding: 1rem;
            font-weight: 600;
            color: var(--admin-dark);
        }

        .admin-table td {
            padding: 1rem;
            border: none;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        /* Status Badges */
        .status-badge {
            padding: 0.375rem 0.75rem;
            border-radius: 2rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        .status-badge.success {
            background: rgba(5, 150, 105, 0.1);
            color: var(--admin-success);
        }

        .status-badge.warning {
            background: rgba(217, 119, 6, 0.1);
            color: var(--admin-warning);
        }

        .status-badge.danger {
            background: rgba(220, 38, 38, 0.1);
            color: var(--admin-danger);
        }

        .status-badge.info {
            background: rgba(8, 145, 178, 0.1);
            color: var(--admin-info);
        }

        /* Forms */
        .form-control {
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--admin-primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .admin-sidebar {
                width: var(--admin-sidebar-collapsed);
            }
            
            .admin-main {
                margin-left: var(--admin-sidebar-collapsed);
            }
            
            .admin-header {
                padding: 0 1rem;
            }
            
            .admin-content {
                padding: 1rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .page-title {
                font-size: 1.5rem;
            }
        }

        /* Custom Scrollbar */
        .admin-sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .admin-sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .admin-sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 4px;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Admin Sidebar -->
    <div class="admin-sidebar" id="adminSidebar">
        <div class="sidebar-header">
            <span class="sidebar-logo">
                <i class="fas fa-shield-alt"></i>
                <span>Admin Panel</span>
            </span>
            <button class="sidebar-toggle" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        
        <nav class="sidebar-nav">

            
            <div class="nav-item">
                <a href="{{ route('admin.pemesanan.index') }}" class="nav-link {{ request()->routeIs('admin.pemesanan.*') ? 'active' : '' }}">
                    <i class="fas fa-ticket-alt"></i>
                    <span class="nav-text">Pemesanan</span>
                </a>
            </div>
                        <div class="nav-item">
                            <a href="{{ route('admin.destinasi.index') }}" class="nav-link {{ request()->routeIs('admin.destinasi.index') ? 'active' : '' }}">
                                <i class="fas fa-map-marked-alt"></i>
                                <span class="nav-text">Kelola Destinasi</span>
                            </a>
                        </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="admin-main" id="adminMain">
        <!-- Header -->
    <!-- Header removed: dashboard, notifications, profile, breadcrumbs -->

        <!-- Content -->
        <main class="admin-content">
            <!-- Success Alert -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Error Alert -->
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Validation Errors -->
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Terjadi kesalahan!</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Toast Container -->
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1055;"></div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    
    <!-- Custom Admin JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar toggle functionality
            const sidebar = document.getElementById('adminSidebar');
            const mainContent = document.getElementById('adminMain');
            const sidebarToggle = document.getElementById('sidebarToggle');

            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('sidebar-collapsed');
                
                // Save state to localStorage
                localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
            });

            // Restore sidebar state
            const sidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            if (sidebarCollapsed) {
                sidebar.classList.add('collapsed');
                mainContent.classList.add('sidebar-collapsed');
            }

            // Initialize DataTables
            if (typeof $.fn.dataTable !== 'undefined') {
                $('.admin-table').DataTable({
                    responsive: true,
                    pageLength: 25,
                    order: [[0, 'desc']],
                    language: {
                        search: "Cari:",
                        lengthMenu: "Tampilkan _MENU_ data per halaman",
                        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                        infoEmpty: "Tidak ada data",
                        infoFiltered: "(difilter dari _MAX_ total data)",
                        paginate: {
                            first: "Pertama",
                            last: "Terakhir",
                            next: "Selanjutnya",
                            previous: "Sebelumnya"
                        },
                        emptyTable: "Tidak ada data tersedia",
                        zeroRecords: "Tidak ditemukan data yang sesuai"
                    }
                });
            }

            // Auto-hide alerts after 5 seconds
            setTimeout(() => {
                const alerts = document.querySelectorAll('.alert-dismissible');
                alerts.forEach(alert => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
        });

        // Utility functions
        function showToast(message, type = 'info') {
            const toastContainer = document.querySelector('.toast-container');
            const toast = document.createElement('div');
            toast.className = `toast align-items-center text-bg-${type} border-0`;
            toast.setAttribute('role', 'alert');
            toast.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">${message}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            `;
            
            toastContainer.appendChild(toast);
            const bsToast = new bootstrap.Toast(toast);
            bsToast.show();
            
            toast.addEventListener('hidden.bs.toast', () => {
                toast.remove();
            });
        }

        function confirmDelete(message = 'Apakah Anda yakin ingin menghapus data ini?') {
            return confirm(message);
        }

        // CSRF token for AJAX requests
        if (typeof $ !== 'undefined') {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        }
    </script>
    
    @stack('scripts')
</body>
</html>