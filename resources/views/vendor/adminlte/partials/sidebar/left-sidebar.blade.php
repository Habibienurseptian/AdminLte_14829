<aside class="main-sidebar elevation-4" style="background-color: #1E3A8A">

    {{-- Sidebar brand logo --}}
    <div class="nav nav-pills nav-sidebar flex-column">
        <a href="/" class="brand-link text-center" style="padding: 1rem 0; display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-clinic-medical mr-2" style="font-size: 1.75rem; color: #ffffff;"></i>
            <span class="brand-text font-weight-bold logo-text-hide-on-collapse" style="font-size: 2rem; color: #ffffff; font-family: 'Segoe UI', sans-serif;">Poliklinik</span>
        </a>
    </div>

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu"
                @if(config('adminlte.sidebar_nav_animation_speed') != 300)
                    data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}"
                @endif
                @if(!config('adminlte.sidebar_nav_accordion'))
                    data-accordion="false"
                @endif>

                {{-- Custom Styles --}}
                <style>
                    .sidebar-collapse .logo-text-hide-on-collapse {
                        display: none !important;
                    }
                    .sidebar-mini .brand-link {
                        justify-content: center !important;
                    }
                    .sidebar-mini .brand-image {
                        margin-right: 0 !important;
                    }
                    .nav-sidebar .nav-link {
                        color: #ffffff;
                        transition: background-color 0.3s ease, color 0.3s ease;
                    }
                    .nav-sidebar .nav-link.active {
                        background-color: #3B82F6;
                        color: #ffffff;
                    }
                    .nav-sidebar .nav-link:hover {
                        background-color: #2563EB;
                        color: #ffffff;
                    }
                    .nav-sidebar .nav-link:hover p,
                    .nav-sidebar .nav-link:hover span,
                    .nav-sidebar .nav-link:hover .nav-icon,
                    .nav-sidebar .nav-link:hover i {
                        color: #ffffff;
                    }
                    .nav-sidebar .nav-icon {
                        margin-right: 0.5rem;
                    }
                </style>

                {{-- Menu Dinamis --}}
                @if(request()->is('admin*'))
                    <li class="nav-item">
                        <a href="/admin" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/dokter" class="nav-link {{ request()->is('admin/dokter') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-md"></i>
                            <p>Dokter</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/pasien" class="nav-link {{ request()->is('admin/pasien') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-injured"></i>
                            <p>Pasien</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/poli" class="nav-link {{ request()->is('admin/poli') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-clinic-medical"></i>
                            <p>Poli</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/obat" class="nav-link {{ request()->is('admin/obat') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-pills"></i>
                            <p>Obat</p>
                        </a>
                    </li>

                @elseif(request()->is('dokter*'))
                    <li class="nav-item">
                        <a href="/dokter" class="nav-link {{ request()->is('dokter') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/dokter/periksa" class="nav-link {{ request()->is('dokter/periksa') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-md"></i>
                            <p>Periksa Pasien</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/dokter/jadwal" class="nav-link {{ request()->is('dokter/jadwal') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>Jadwal Periksa</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/dokter/riwayat" class="nav-link {{ request()->is('dokter/riwayat') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-history"></i>
                            <p>Riwayat Pasien</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/dokter/profile" class="nav-link {{ request()->is('dokter/profile') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-circle"></i>
                            <p>Profil</p>
                        </a>
                    </li>

                @elseif(request()->is('pasien*'))
                    <li class="nav-item">
                        <a href="/pasien" class="nav-link {{ request()->is('pasien') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/pasien/periksa" class="nav-link {{ request()->is('pasien/periksa') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Periksa</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/pasien/riwayat" class="nav-link {{ request()->is('pasien/riwayat') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Riwayat</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/pasien/profile" class="nav-link {{ request()->is('pasien/profile') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-circle"></i>
                            <p>Profil</p>
                        </a>
                    </li>

                @else
                    <li class="nav-item">
                        <a href="/register" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Register</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/login" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Login</p>
                        </a>
                    </li>
                    
                @endif
            </ul>
        </nav>
    </div>
</aside>
