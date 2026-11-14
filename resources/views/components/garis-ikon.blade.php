@props(['name', 'class' => 'w-5 h-5'])
{{-- Ikon garis sederhana (SVG lokal), pengganti font ikon dari luar --}}
<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
@switch($name)
    @case('arrow')<path d="M4 12h15"/><path d="M13 6l6 6-6 6"/>@break
    @case('chevron')<path d="M9 6l6 6-6 6"/>@break
    @case('menu')<path d="M4 7h16"/><path d="M4 12h16"/><path d="M4 17h10"/>@break
    @case('close')<path d="M6 6l12 12"/><path d="M18 6L6 18"/>@break
    @case('moon')<path d="M20 14.5A8 8 0 1 1 9.5 4a6.5 6.5 0 0 0 10.5 10.5z"/>@break
    @case('sun')<circle cx="12" cy="12" r="4"/><path d="M12 2.5v2M12 19.5v2M2.5 12h2M19.5 12h2M5.3 5.3l1.4 1.4M17.3 17.3l1.4 1.4M5.3 18.7l1.4-1.4M17.3 6.7l1.4-1.4"/>@break
    @case('pin')<path d="M12 21s-7-6.2-7-11.5a7 7 0 0 1 14 0C19 14.8 12 21 12 21z"/><circle cx="12" cy="9.5" r="2.5"/>@break
    @case('clock')<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>@break
    @case('search-off')<circle cx="11" cy="11" r="6"/><path d="M20 20l-4.5-4.5"/><path d="M3 3l18 18"/>@break
@endswitch
</svg>
