<?php

namespace App\Support;

class ImageUrl
{
    /**
     * Gambar bawaan (seed) disimpan di public/images, gambar unggahan admin di disk "public".
     * Kalau kosong, pakai gambar pengganti netral (bukan foto produk lain).
     */
    public static function resolve(?string $path, string $fallback = 'images/foto-menyusul.svg'): string
    {
        if (blank($path)) {
            return asset($fallback);
        }

        if (str_starts_with($path, 'images/')) {
            return asset($path);
        }

        return asset('storage/' . ltrim($path, '/'));
    }
}
