@inject('preloaderHelper', 'JeroenNoten\LaravelAdminLte\Helpers\PreloaderHelper')

<div class="{{ $preloaderHelper->makePreloaderClasses() }}"
     style="{{ $preloaderHelper->makePreloaderStyle() }}; display: flex; flex-direction: column; justify-content: center; align-items: center;">

    {{-- Ikon SVG Poliklinik dengan animasi --}}
    <svg width="80" height="80" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"
        class="mb-3 animate__animated animate__pulse animate__infinite">
        <!-- Bangunan -->
        <rect x="10" y="18" width="44" height="36" rx="4" fill="#e9f2ff" stroke="#007bff" stroke-width="2"/>
        
        <!-- Jendela kiri -->
        <rect x="16" y="26" width="8" height="8" rx="1" fill="#fff" stroke="#007bff" stroke-width="1"/>
        
        <!-- Jendela kanan -->
        <rect x="40" y="26" width="8" height="8" rx="1" fill="#fff" stroke="#007bff" stroke-width="1"/>

        <!-- Pintu -->
        <rect x="28" y="36" width="8" height="14" fill="#007bff" rx="1"/>

        <!-- Tanda Plus -->
        <circle cx="32" cy="12" r="8" fill="#007bff"/>
        <path d="M32 8V16M28 12H36" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
    </svg>

    {{-- Teks memuat --}}
    <div class="text-center">
        <p class="fw-semibold text-muted mb-0" style="font-size: 1.1rem;">Memuat Sistem Poliklinik...</p>
    </div>

</div>
