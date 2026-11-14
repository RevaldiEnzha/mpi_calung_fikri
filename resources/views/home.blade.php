<x-layout>
    @php
        $wa = $profile->whatsappLink();
        $kota = $profile->address ? \Illuminate\Support\Str::before($profile->address, ', Jawa') : 'Banyumas';
        $stepHeights = ['lg:h-[360px]', 'lg:h-[325px]', 'lg:h-[290px]', 'lg:h-[255px]', 'lg:h-[220px]'];
    @endphp

    {{-- Pembuka --}}
    <section class="max-w-container-max mx-auto px-gutter pt-12 md:pt-20 pb-16">
        <p class="eyebrow reveal-on-scroll">Perajin alat musik bambu{{ $profile->since_year ? ' sejak ' . $profile->since_year : '' }} &middot; Banyumas</p>
        <h1 class="reveal-on-scroll font-display text-[2.9rem] sm:text-6xl lg:text-[5.4rem] leading-[0.98] tracking-tight mt-5 max-w-5xl text-ink">
            Calung bambu wulung, <em class="text-amber">dibuat sesuai pesanan.</em>
        </h1>

        <div class="mt-12 grid lg:grid-cols-12 gap-10 lg:gap-8 items-end">
            <div class="lg:col-span-4 reveal-on-scroll" data-delay="80">
                <p class="text-lg text-ink-soft leading-relaxed">
                    {{ $profile->business_name }} membuat calung Banyumasan, angklung, dan kerajinan bambu di {{ $kota }}. Pilih alatnya di katalog, lalu tanyakan pesananmu lewat WhatsApp.
                </p>
                <div class="mt-7 flex flex-wrap gap-3">
                    <a href="{{ route('katalog') }}" data-testid="hero-katalog" class="btn btn-ink">Lihat katalog <x-garis-ikon name="arrow" class="w-4 h-4 arrow"/></a>
                    @if($wa)
                    <a href="{{ $wa }}" target="_blank" rel="noopener" data-testid="hero-wa" class="btn btn-line"><x-wa-icon class="w-4 h-4"/> Tanya dulu</a>
                    @endif
                </div>
            </div>

            <figure class="lg:col-span-5 reveal-on-scroll" data-delay="160">
                <div class="relative overflow-hidden rounded-[3px] aspect-[4/3] bg-tint group">
                    <img src="{{ $profile->cover_image_url }}" alt="Calung buatan {{ $profile->business_name }}" fetchpriority="high" class="w-full h-full object-cover transition-transform duration-[1.2s] group-hover:scale-[1.04]"/>
                </div>
                <figcaption class="mt-2 font-mono text-[11px] text-muted">Calung Banyumasan dari bengkel di Desa Kemutug Lor.</figcaption>
            </figure>

            <dl class="lg:col-span-3 reveal-on-scroll border-t border-ink" data-delay="240">
                @foreach([['Bahan', 'Bambu wulung pilihan'], ['Nada', 'Disetel dengan tuner'], ['Pemesanan', 'Satu per satu, sesuai kebutuhan'], ['Pengiriman', 'Sampai luar Jawa']] as [$k, $v])
                <div class="py-3.5 border-b border-rule flex justify-between gap-4">
                    <dt class="eyebrow pt-0.5">{{ $k }}</dt>
                    <dd class="text-sm font-semibold text-right text-ink">{{ $v }}</dd>
                </div>
                @endforeach
                <div class="bilah mt-6" aria-hidden="true"><span></span><span></span><span></span><span></span><span></span><span></span><span></span></div>
            </dl>
        </div>
    </section>

    {{-- Katalog pilihan --}}
    <section class="max-w-container-max mx-auto px-gutter py-14" id="unggulan">
        <div class="grid md:grid-cols-12 gap-6 items-end mb-10 reveal-on-scroll">
            <div class="md:col-span-8">
                <p class="eyebrow">Katalog &middot; {{ str_pad((string) $featured->count(), 2, '0', STR_PAD_LEFT) }} pilihan</p>
                <h2 class="font-display text-4xl md:text-5xl mt-2 leading-tight">Pilihan dari bengkel</h2>
            </div>
            <div class="md:col-span-4 md:text-right">
                <a href="{{ route('katalog') }}" class="link-arrow text-ink">Semua produk <x-garis-ikon name="arrow" class="w-4 h-4"/></a>
            </div>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">
            @forelse($featured as $i => $product)
                <x-product-card :product="$product" :delay="($i + 1) * 100"/>
            @empty
                <p class="text-ink-soft">Belum ada produk.</p>
            @endforelse
        </div>
    </section>

    {{-- Proses, foto disusun makin pendek seperti bilah calung --}}
    @if($steps->isNotEmpty())
    <section class="mt-8 py-16 bg-tint/60 border-y border-rule">
        <div class="max-w-container-max mx-auto px-gutter">
            <div class="grid md:grid-cols-12 gap-6 items-end reveal-on-scroll">
                <div class="md:col-span-7">
                    <p class="eyebrow">Proses pembuatan</p>
                    <h2 class="font-display text-4xl md:text-5xl mt-2 leading-tight">Dari batang bambu sampai <em class="text-amber">siap dimainkan</em></h2>
                </div>
                <p class="md:col-span-5 text-ink-soft">Setiap alat dikerjakan tangan. Bilah dipotong, dikeringkan, lalu nadanya disetel satu per satu sebelum dirangkai.</p>
            </div>
            <ol data-testid="home-steps" class="mt-12 grid grid-cols-2 lg:grid-cols-5 gap-5 lg:items-end">
                @foreach($steps as $i => $step)
                <li class="reveal-on-scroll group" data-delay="{{ $i * 90 }}">
                    <div class="overflow-hidden rounded-[3px] bg-tint aspect-square lg:aspect-auto {{ $stepHeights[$i] ?? 'lg:h-[220px]' }}">
                        <img src="{{ $step->image_url }}" alt="{{ $step->title }}" loading="lazy" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"/>
                    </div>
                    <div class="mt-3 flex items-baseline gap-2.5">
                        <span class="font-mono text-xs text-amber">{{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}</span>
                        <h3 class="font-semibold text-ink leading-snug">{{ $step->title }}</h3>
                    </div>
                </li>
                @endforeach
            </ol>
            <a href="{{ route('profil') }}#proses" class="mt-10 link-arrow text-ink">Baca proses lengkap <x-garis-ikon name="arrow" class="w-4 h-4"/></a>
        </div>
    </section>
    @endif

    {{-- Ajakan pesan --}}
    <section class="max-w-container-max mx-auto px-gutter pt-16">
        <div class="relative overflow-hidden bg-band text-on-ink rounded-[3px] px-8 py-12 md:px-14 md:py-14 reveal-on-scroll">
            <div class="grid md:grid-cols-12 gap-8 items-center">
                <div class="md:col-span-8">
                    <p class="font-mono text-[11px] tracking-[0.14em] uppercase opacity-60">Untuk sanggar, sekolah, dan grup kesenian</p>
                    <h2 class="font-display text-4xl md:text-5xl mt-3 leading-tight">Ceritakan alat yang kamu butuhkan.</h2>
                    <p class="mt-4 opacity-75 max-w-xl">Sampaikan jenis alat, jumlah, dan nada. Harga dan lama pengerjaan dikonfirmasi langsung lewat WhatsApp.</p>
                </div>
                <div class="md:col-span-4 flex md:flex-col md:items-end gap-6 items-center justify-between">
                    <div class="bilah" aria-hidden="true"><span></span><span></span><span></span><span></span><span></span><span></span><span></span></div>
                    @if($wa)
                    <a href="{{ $wa }}" target="_blank" rel="noopener" class="btn border-amber bg-amber text-[#1A1417] hover:-translate-y-0.5 hover:brightness-110">
                        <x-wa-icon class="w-4 h-4"/> Chat sekarang
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
</x-layout>
