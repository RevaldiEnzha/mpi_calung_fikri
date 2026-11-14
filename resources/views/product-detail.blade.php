<x-layout :title="$product->name">
    @php
        $wa = $profile->whatsappLink($product->name);
        $no = str_pad((string) ($product->sort_order ?: $product->id), 2, '0', STR_PAD_LEFT);
    @endphp

    <section class="max-w-container-max mx-auto px-gutter pt-8 pb-12">
        <nav class="flex items-center gap-1.5 font-mono text-[11px] tracking-wide uppercase text-muted mb-8" aria-label="Breadcrumb">
            <a href="{{ route('katalog') }}" class="hover:text-amber transition-colors">Katalog</a>
            <x-garis-ikon name="chevron" class="w-3.5 h-3.5"/>
            <span class="text-ink">{{ $product->name }}</span>
        </nav>

        <div class="grid lg:grid-cols-12 gap-10 lg:gap-14 items-start">
            <div class="lg:col-span-7 reveal-on-scroll">
                <div class="relative overflow-hidden rounded-[3px] bg-tint aspect-[4/3]">
                    <img data-testid="detail-image" src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover"/>
                    <span class="absolute top-0 left-0 bg-paper/90 backdrop-blur px-3 py-1.5 font-mono text-xs tracking-wider">No. {{ $no }}</span>
                </div>
            </div>

            <div class="lg:col-span-5 reveal-on-scroll" data-delay="120">
                <p class="eyebrow">{{ $product->category ?: 'Produk' }}</p>
                <h1 data-testid="detail-name" class="font-display text-5xl md:text-6xl mt-2 leading-[1.02] tracking-tight">{{ $product->name }}</h1>
                @if($product->is_made_to_order)
                <p data-testid="detail-badge-pesanan" class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-clay"><span class="w-2 h-2 rounded-full bg-clay"></span>Dibuat sesuai pesanan</p>
                @endif
                <p class="mt-4 text-lg text-ink-soft leading-relaxed">{{ $product->description }}</p>

                <dl class="mt-7 border-t border-ink">
                    <div class="py-4 border-b border-rule flex justify-between items-baseline gap-4">
                        <dt class="eyebrow">Harga</dt>
                        <dd data-testid="detail-price" class="font-display text-3xl text-ink">{{ $product->formatted_price }}</dd>
                    </div>
                    <div class="py-4 border-b border-rule flex justify-between items-baseline gap-4">
                        <dt class="eyebrow">Perkiraan pengerjaan</dt>
                        <dd data-testid="detail-lead-time" class="font-semibold text-right">{{ $product->lead_time ?: 'Dikonfirmasi saat pemesanan' }}</dd>
                    </div>
                </dl>

                @if(filled($product->content))
                <div class="prose-calung mt-6 text-ink-soft">{!! $product->content !!}</div>
                @endif

                <div class="mt-8">
                    @if($wa)
                    <a href="{{ $wa }}" target="_blank" rel="noopener" data-testid="wa-button" class="btn btn-ink w-full !py-4 text-base">
                        <x-wa-icon class="w-5 h-5"/> Pesan lewat WhatsApp <x-garis-ikon name="arrow" class="w-4 h-4 arrow"/>
                    </a>
                    @else
                    <p data-testid="wa-missing" class="text-ink-soft">Nomor WhatsApp belum diatur oleh admin.</p>
                    @endif
                    <p class="mt-3 text-xs text-muted leading-relaxed">Tombol ini membuka WhatsApp dengan pesan berisi nama produk. Percakapan berlangsung di WhatsApp, website tidak menyimpan isi chat.</p>
                </div>
            </div>
        </div>
    </section>

    @if($related->isNotEmpty())
    <section class="max-w-container-max mx-auto px-gutter py-10">
        <div class="flex items-end justify-between gap-4 mb-8 border-t border-ink pt-6">
            <h2 class="font-display text-3xl md:text-4xl">Produk lain</h2>
            <a href="{{ route('katalog') }}" class="link-arrow text-ink text-sm">Semua produk <x-garis-ikon name="arrow" class="w-4 h-4"/></a>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">
            @foreach($related as $i => $item)
                <x-product-card :product="$item" :delay="($i + 1) * 90"/>
            @endforeach
        </div>
    </section>
    @endif
</x-layout>
