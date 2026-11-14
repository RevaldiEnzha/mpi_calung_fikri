<x-layout title="Profil & Proses">
    @php $wa = $profile->whatsappLink(); @endphp

    <section class="max-w-container-max mx-auto px-gutter pt-12 md:pt-16 pb-12">
        <p class="eyebrow reveal-on-scroll">Profil usaha</p>
        <h1 class="reveal-on-scroll font-display text-5xl md:text-7xl mt-3 leading-[1] tracking-tight">{{ $profile->business_name }}</h1>

        <div class="mt-12 grid lg:grid-cols-12 gap-10">
            <div class="lg:col-span-7 reveal-on-scroll">
                <dl class="border-t border-ink grid sm:grid-cols-2">
                    @foreach(array_filter([
                        ['Pemilik dan perajin', $profile->owner_name],
                        ['Berdiri', $profile->since_year],
                        ['Bengkel', $profile->address],
                        ['Sistem pemesanan', 'Dibuat sesuai pesanan, dikonfirmasi lewat WhatsApp'],
                    ], fn ($r) => filled($r[1])) as [$k, $v])
                    <div class="py-4 border-b border-rule sm:pr-6">
                        <dt class="eyebrow">{{ $k }}</dt>
                        <dd class="mt-1.5 font-semibold text-ink leading-snug">{{ $v }}</dd>
                    </div>
                    @endforeach
                </dl>
                <div data-testid="profil-about" class="mt-8 space-y-4 text-ink-soft text-[1.05rem] leading-relaxed max-w-2xl">
                    @foreach(preg_split("/\n\s*\n/", trim((string) $profile->about)) as $para)
                        @if(filled($para))<p>{{ $para }}</p>@endif
                    @endforeach
                </div>
            </div>
            <figure class="lg:col-span-5 reveal-on-scroll" data-delay="150">
                <div class="overflow-hidden rounded-[3px] bg-tint">
                    <img src="{{ asset('images/calung/papan-usaha.jpg') }}" alt="Papan usaha {{ $profile->business_name }}" class="w-full h-auto object-cover"/>
                </div>
                <figcaption class="mt-2 font-mono text-[11px] text-muted">Papan usaha di bengkel {{ $profile->business_name }}.</figcaption>
            </figure>
        </div>
    </section>

    <section id="proses" class="max-w-container-max mx-auto px-gutter py-12">
        <div class="grid md:grid-cols-12 gap-6 items-end reveal-on-scroll">
            <div class="md:col-span-7">
                <p class="eyebrow">Proses pembuatan</p>
                <h2 class="font-display text-4xl md:text-5xl mt-2 leading-tight">Bagaimana calung <em class="text-amber">dibuat</em></h2>
            </div>
            <p class="md:col-span-5 text-ink-soft">Setiap alat dikerjakan tangan, dari memilih bambu sampai menyetel nada.</p>
        </div>
        <ol data-testid="process-steps" class="mt-10 border-t border-ink">
            @forelse($steps as $i => $step)
            <li class="reveal-on-scroll group grid md:grid-cols-12 gap-5 md:gap-8 py-8 border-b border-rule items-center">
                <span class="md:col-span-2 font-display text-6xl md:text-7xl leading-none text-amber/70 group-hover:text-amber transition-colors">{{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}</span>
                <div class="md:col-span-4 overflow-hidden rounded-[3px] aspect-[4/3] bg-tint">
                    <img src="{{ $step->image_url }}" alt="{{ $step->title }}" loading="lazy" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"/>
                </div>
                <div class="md:col-span-6">
                    <h3 class="font-display text-3xl leading-tight">{{ $step->title }}</h3>
                    <p class="mt-3 text-ink-soft leading-relaxed">{{ $step->description }}</p>
                </div>
            </li>
            @empty
            <li class="py-6 text-ink-soft">Tahapan proses belum diisi.</li>
            @endforelse
        </ol>
    </section>

    <section class="max-w-container-max mx-auto px-gutter py-10">
        <div class="border border-ink rounded-[3px] p-8 md:p-10 grid md:grid-cols-12 gap-6 items-center reveal-on-scroll">
            <div class="md:col-span-7">
                <h2 class="font-display text-3xl md:text-4xl leading-tight">Lihat alat yang bisa dipesan</h2>
                <p class="mt-2 text-ink-soft">Calung, angklung, pelengkap, dan kerajinan bambu.</p>
            </div>
            <div class="md:col-span-5 flex flex-wrap md:justify-end gap-3">
                <a href="{{ route('katalog') }}" class="btn btn-ink">Buka katalog <x-garis-ikon name="arrow" class="w-4 h-4 arrow"/></a>
                @if($wa)
                <a href="{{ $wa }}" target="_blank" rel="noopener" class="btn btn-line"><x-wa-icon class="w-4 h-4"/> WhatsApp</a>
                @endif
            </div>
        </div>
    </section>
</x-layout>
