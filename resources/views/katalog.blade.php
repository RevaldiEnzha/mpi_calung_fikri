<x-layout title="Katalog">
    <section class="max-w-container-max mx-auto px-gutter pt-12 md:pt-16 pb-4">
        <div class="grid md:grid-cols-12 gap-6 items-end reveal-on-scroll">
            <div class="md:col-span-8">
                <p class="eyebrow">Katalog &middot; {{ str_pad((string) $products->count(), 2, '0', STR_PAD_LEFT) }} produk</p>
                <h1 class="font-display text-5xl md:text-7xl mt-3 leading-[1] tracking-tight">Alat musik dan <em class="text-amber">kerajinan bambu</em></h1>
            </div>
            <p class="md:col-span-4 text-ink-soft">Semua produk dibuat sesuai pesanan. Buka produk untuk melihat harga, perkiraan lama pengerjaan, dan tombol WhatsApp.</p>
        </div>

        @if($categories->isNotEmpty())
        <div class="mt-10 border-b border-rule flex flex-wrap" id="product-filters" data-filter-items="#product-grid .product-item" data-filter-empty="#empty-filter" role="group" aria-label="Filter kategori">
            <button type="button" data-category="Semua" data-testid="filter-Semua" class="filter-btn is-active">Semua</button>
            @foreach($categories as $cat)
            <button type="button" data-category="{{ $cat }}" data-testid="filter-{{ \Illuminate\Support\Str::slug($cat) }}" class="filter-btn">{{ $cat }}</button>
            @endforeach
        </div>
        @endif
    </section>

    <section class="max-w-container-max mx-auto px-gutter pt-8 pb-8">
        <div id="product-grid" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">
            @forelse($products as $i => $product)
                <x-product-card :product="$product" :delay="($i % 3 + 1) * 90"/>
            @empty
                <p class="col-span-full text-center text-ink-soft py-12">Belum ada produk dalam katalog.</p>
            @endforelse
        </div>
        <div id="empty-filter" class="hidden text-center text-ink-soft py-16">
            <x-garis-ikon name="search-off" class="w-10 h-10 mx-auto text-muted"/>
            <p class="mt-3">Belum ada produk di kategori ini.</p>
        </div>
    </section>
</x-layout>
