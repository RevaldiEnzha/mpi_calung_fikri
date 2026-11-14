@props(['product', 'delay' => 0, 'index' => null])
<a href="{{ route('product-detail', $product->id) }}" data-testid="product-card" data-category="{{ $product->category }}"
   class="product-item product-card group reveal-on-scroll flex flex-col" data-delay="{{ $delay }}">
    <div class="thumb relative aspect-[4/3] overflow-hidden bg-tint rounded-[3px]">
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" loading="lazy" decoding="async" class="w-full h-full object-cover"/>
        <span class="absolute top-0 left-0 bg-paper/90 backdrop-blur px-2.5 py-1 font-mono text-[11px] tracking-wider text-ink">No. {{ str_pad((string) ($index ?? $product->sort_order ?: $product->id), 2, '0', STR_PAD_LEFT) }}</span>
    </div>
    <div class="pt-4 pb-1 border-b border-rule flex-1 flex flex-col">
        <p class="eyebrow">{{ $product->category ?: 'Produk' }}</p>
        <h3 class="mt-1.5 font-display text-[1.7rem] leading-tight text-ink"><span class="title">{{ $product->name }}</span></h3>
        <p class="mt-2 text-sm text-ink-soft line-clamp-2 flex-1">{{ $product->description }}</p>
        <div class="mt-4 mb-3 flex items-end justify-between gap-3">
            <div>
                <span class="block font-semibold text-ink">{{ $product->formatted_price }}</span>
                @if($product->is_made_to_order)
                <span data-testid="badge-pesanan" class="mt-1 inline-flex items-center gap-1.5 text-xs text-clay font-medium"><span class="w-1.5 h-1.5 rounded-full bg-clay"></span>Dibuat sesuai pesanan</span>
                @endif
            </div>
            <span class="w-9 h-9 shrink-0 border border-rule rounded-sm flex items-center justify-center text-ink-soft group-hover:bg-ink group-hover:text-paper group-hover:border-ink transition-colors">
                <x-garis-ikon name="arrow" class="w-4 h-4"/>
            </span>
        </div>
    </div>
</a>
