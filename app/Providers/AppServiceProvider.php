<?php

namespace App\Providers;

use App\Models\BusinessProfile;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Carbon::setLocale('id');

        // Profil usaha (nama, alamat, nomor WA) dipakai di semua halaman publik.
        View::composer(
            ['components.layout', 'home', 'profil', 'katalog', 'product-detail'],
            fn ($view) => $view->with('profile', once(fn () => BusinessProfile::current())),
        );
    }
}
