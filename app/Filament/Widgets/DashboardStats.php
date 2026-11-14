<?php

namespace App\Filament\Widgets;

use App\Models\BusinessProfile;
use App\Models\ProcessStep;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends BaseWidget
{
    protected function getStats(): array
    {
        $profile = BusinessProfile::current();

        return [
            Stat::make('Produk di katalog', Product::count())
                ->description(Product::where('is_featured', true)->count() . ' tampil di beranda')
                ->descriptionIcon('heroicon-m-squares-2x2')
                ->color('primary'),
            Stat::make('Tahap proses', ProcessStep::count())
                ->description('Tampil di halaman Profil & Proses')
                ->descriptionIcon('heroicon-m-wrench-screwdriver')
                ->color('success'),
            Stat::make('Nomor WhatsApp', $profile->whatsapp_number ?: 'Belum diisi')
                ->description($profile->is_demo ? 'Masih nomor uji (mode demo)' : 'Nomor aktif')
                ->descriptionIcon('heroicon-m-chat-bubble-left-right')
                ->color($profile->is_demo ? 'warning' : 'success'),
        ];
    }
}
