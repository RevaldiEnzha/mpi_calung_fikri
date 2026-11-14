@props(['title' => null])
@php
    $siteName = $profile->business_name ?? 'Mandiri Laras Production';
    $waGeneral = $profile->whatsappLink();
    $navItems = [
        ['route' => 'home', 'match' => 'home', 'label' => 'Beranda', 'id' => 'home'],
        ['route' => 'profil', 'match' => 'profil', 'label' => 'Profil & Proses', 'id' => 'profil'],
        ['route' => 'katalog', 'match' => 'katalog*', 'label' => 'Katalog', 'id' => 'katalog'],
    ];
    // detail produk juga dianggap bagian katalog
    $isActive = fn ($item) => request()->routeIs($item['match']) || ($item['id'] === 'katalog' && request()->routeIs('product-detail'));
@endphp
<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>{{ $title ? $title . ' | ' . $siteName : $siteName . ' | Calung dan Angklung Bambu' }}</title>
    <meta name="description" content="{{ $profile->tagline ?? 'Calung dan angklung bambu wulung, dibuat sesuai pesanan.' }}"/>
    <meta name="turbo-cache-control" content="no-preview"/>
    <script>
        (function () {
            var t = null;
            try { t = localStorage.getItem('mlp-theme'); } catch (e) {}
            if (t !== 'light' && t !== 'dark') {
                t = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            }
            document.documentElement.setAttribute('data-theme', t);
        })();
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Manrope:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500&display=swap"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="min-h-screen flex flex-col text-ink font-body antialiased">

@if($profile->is_demo)
<div id="demo-banner" data-testid="demo-banner" class="demo-stripe text-center text-xs sm:text-[13px] font-semibold px-4 py-1.5">
    <span class="bg-[#F6EBD6] px-2 py-0.5 rounded-sm"><span class="sm:hidden">Versi demo, data masih data uji.</span><span class="hidden sm:inline">Versi demo internal. Data produk dan nomor WhatsApp masih data uji.</span></span>
</div>
@endif

<nav id="main-nav" class="sticky top-0 z-50 bg-paper/85 backdrop-blur-md border-b border-rule transition-shadow duration-300">
    <div class="max-w-container-max mx-auto px-gutter h-[68px] flex items-center justify-between gap-6">
        <a id="nav-logo" data-testid="nav-logo" href="{{ route('home') }}" class="flex items-center gap-3 text-ink group">
            <x-logo-mark class="w-10 h-10 text-amber transition-transform duration-500 group-hover:rotate-[-8deg]"/>
            <span class="leading-none">
                <span class="block font-display text-[1.45rem] tracking-tight">{{ \Illuminate\Support\Str::of($siteName)->replace(' Production', '') }}</span>
                @if(\Illuminate\Support\Str::endsWith($siteName, 'Production'))
                <span class="block font-mono text-[10px] tracking-[0.3em] text-muted mt-0.5">PRODUCTION</span>
                @endif
            </span>
        </a>

        <div class="hidden md:flex items-center gap-8">
            @foreach($navItems as $n => $item)
            <a id="nav-{{ $item['id'] }}" data-testid="nav-{{ $item['id'] }}" href="{{ route($item['route']) }}" class="nav-link"
               @if($isActive($item)) aria-current="page" @endif><span class="font-mono text-[10px] text-muted mr-1.5">0{{ $n + 1 }}</span>{{ $item['label'] }}</a>
            @endforeach
        </div>

        <div class="flex items-center gap-2">
            <button type="button" id="theme-toggle" data-testid="theme-toggle" class="w-10 h-10 rounded-sm border border-rule text-ink-soft hover:text-amber hover:border-amber transition-colors flex items-center justify-center" aria-label="Ganti tema terang atau gelap">
                <x-garis-ikon name="moon" class="w-[18px] h-[18px] theme-icon-dark"/>
                <x-garis-ikon name="sun" class="w-[18px] h-[18px] theme-icon-light"/>
            </button>
            @if($waGeneral)
            <a id="nav-wa" data-testid="nav-wa" href="{{ $waGeneral }}" target="_blank" rel="noopener" class="hidden md:inline-flex btn btn-line !py-2 !px-4 text-sm">
                <x-wa-icon class="w-4 h-4"/> Tanya pesanan
            </a>
            @endif
            <button type="button" id="mobile-menu-btn" data-testid="mobile-menu-btn" class="md:hidden w-10 h-10 rounded-sm border border-rule text-ink flex items-center justify-center" aria-label="Buka menu" aria-expanded="false" aria-controls="mobile-menu">
                <x-garis-ikon name="menu" class="w-5 h-5 menu-icon-open"/>
                <x-garis-ikon name="close" class="w-5 h-5 menu-icon-close"/>
            </button>
        </div>
    </div>

    <div id="mobile-menu" data-testid="mobile-menu" class="md:hidden hidden border-t border-rule bg-paper">
        <div class="px-gutter py-3 flex flex-col">
            @foreach($navItems as $n => $item)
            <a data-testid="nav-{{ $item['id'] }}-mobile" href="{{ route($item['route']) }}" class="py-3.5 border-b border-rule flex items-baseline gap-3 {{ $isActive($item) ? 'text-ink font-semibold' : 'text-ink-soft' }}">
                <span class="font-mono text-[11px] text-amber">0{{ $n + 1 }}</span><span class="font-display text-2xl">{{ $item['label'] }}</span>
            </a>
            @endforeach
            @if($waGeneral)
            <a data-testid="nav-wa-mobile" href="{{ $waGeneral }}" target="_blank" rel="noopener" class="btn btn-ink mt-4 mb-2">
                <x-wa-icon class="w-4 h-4"/> Tanya pesanan lewat WhatsApp
            </a>
            @endif
        </div>
    </div>
</nav>

<div class="flex-1">
    <main id="konten">
    {{ $slot }}
    </main>
</div>

<footer class="mt-20 border-t border-rule">
    <div class="max-w-container-max mx-auto px-gutter pt-14 pb-10 grid gap-10 md:grid-cols-[1.4fr_1fr_1fr]">
        <div>
            <div class="flex items-center gap-3 text-amber">
                <x-logo-mark class="w-11 h-11"/>
                <span class="font-display text-3xl text-ink">{{ $siteName }}</span>
            </div>
            <p class="mt-4 text-ink-soft max-w-sm leading-relaxed">{{ $profile->tagline }}</p>
            <div class="bilah mt-6" aria-hidden="true"><span></span><span></span><span></span><span></span><span></span><span></span><span></span></div>
        </div>
        <div>
            <p class="eyebrow mb-3">Bengkel</p>
            <p class="text-sm text-ink-soft leading-relaxed">{{ $profile->address ?: 'Alamat belum diisi.' }}</p>
        </div>
        <div>
            <p class="eyebrow mb-3">Hubungi</p>
            @if($waGeneral)
            <a data-testid="footer-wa" href="{{ $waGeneral }}" target="_blank" rel="noopener" class="link-arrow text-sm">
                <x-wa-icon class="w-4 h-4"/> WhatsApp
            </a>
            @endif
            <div class="flex gap-4 mt-4 text-sm">
                @foreach(['instagram' => 'Instagram', 'facebook' => 'Facebook', 'tiktok' => 'TikTok'] as $field => $label)
                    @if(filled($profile->$field))
                    <a href="{{ $profile->$field }}" target="_blank" rel="noopener" class="text-ink-soft hover:text-amber transition-colors">{{ $label }}</a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="border-t border-rule">
        <div class="max-w-container-max mx-auto px-gutter py-5 flex flex-col sm:flex-row justify-between gap-2 font-mono text-[11px] tracking-wide text-muted">
            <p>© {{ date('Y') }} {{ $siteName }}</p>
            <p>Website dikembangkan oleh Laras Digital Studio</p>
        </div>
    </div>
</footer>

<script>
    function mlpApplyTheme() {
        var t = null;
        try { t = localStorage.getItem('mlp-theme'); } catch (e) {}
        if (t === 'light' || t === 'dark') document.documentElement.setAttribute('data-theme', t);
    }

    function mlpInitReveal() {
        var els = document.querySelectorAll('.reveal-on-scroll:not(.is-revealed)');
        if (!('IntersectionObserver' in window)) { els.forEach(function (el) { el.classList.add('is-revealed'); }); return; }
        var obs = new IntersectionObserver(function (entries, o) {
            entries.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('is-revealed'); o.unobserve(e.target); } });
        }, { threshold: 0.08 });
        els.forEach(function (el) {
            var d = el.getAttribute('data-delay');
            if (d) el.style.transitionDelay = d + 'ms';
            obs.observe(el);
        });
    }

    if (!window.__mlpInit) {
        window.__mlpInit = true;

        document.addEventListener('click', function (e) {
            if (e.target.closest('#theme-toggle')) {
                var next = document.documentElement.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
                document.documentElement.setAttribute('data-theme', next);
                try { localStorage.setItem('mlp-theme', next); } catch (err) {}
                mlpApplyTheme();
                return;
            }
            var btn = e.target.closest('#mobile-menu-btn');
            if (btn) {
                var menu = document.getElementById('mobile-menu');
                var open = menu.classList.toggle('hidden') === false;
                btn.setAttribute('aria-expanded', open ? 'true' : 'false');
                btn.setAttribute('aria-label', open ? 'Tutup menu' : 'Buka menu');
            }
        });

        window.addEventListener('scroll', function () {
            var nav = document.getElementById('main-nav');
            if (nav) nav.classList.toggle('shadow-[0_8px_24px_-18px_rgba(0,0,0,.45)]', window.scrollY > 20);
        }, { passive: true });

        var boot = function () { mlpApplyTheme(); mlpInitReveal(); };
        document.addEventListener('turbo:load', boot);
        document.addEventListener('DOMContentLoaded', function () { if (!window.Turbo) boot(); });
    }
</script>
@stack('scripts')
</body>
</html>
