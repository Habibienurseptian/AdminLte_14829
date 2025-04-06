<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

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

                @if(request()->is('dokter*'))
                    {{-- Default Dokter --}}
                    <li class="nav-item">
                        <a href="/dokter" class="nav-link {{ request()->is('dokter') ? 'active' : '' }}">
                            <i class="fas fa-fw fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/dokter/periksa" class="nav-link {{ request()->is('dokter/periksa*') ? 'active' : '' }}">
                            <i class="fas fa-fw fa-user"></i>
                            <p>Periksa</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/dokter/obat" class="nav-link {{ request()->is('dokter/obat*') ? 'active' : '' }}">
                            <i class="fas fa-fw fa-notes-medical"></i>
                            <p>Obat</p>
                        </a>
                    </li>

                @elseif(request()->is('pasien*'))
                    {{-- Default Pasien --}}
                    <li class="nav-item">
                        <a href="/pasien" class="nav-link {{ request()->is('pasien') ? 'active' : '' }}">
                            <i class="fas fa-fw fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/pasien/periksa" class="nav-link {{ request()->is('pasien/periksa*') ? 'active' : '' }}">
                            <i class="fas fa-fw fa-user"></i>
                            <p>Periksa</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/pasien/riwayat" class="nav-link {{ request()->is('pasien/riwayat*') ? 'active' : '' }}">
                            <i class="fas fa-fw fa-book"></i>
                            <p>Riwayat</p>
                        </a>
                    </li>

                @else
                    {{-- Default menu --}}
                    <li class="nav-item">
                        <a href="/login" class="nav-link active">
                            <i class="fas fa-fw fa-user"></i>
                            <p>Login</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>

</aside>
