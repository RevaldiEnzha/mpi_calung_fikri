<?php

namespace App\Models;

use App\Support\ImageUrl;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class BusinessProfile extends Model
{
    protected $fillable = [
        'business_name', 'owner_name', 'tagline', 'about', 'address', 'since_year',
        'whatsapp_number', 'whatsapp_message', 'instagram', 'facebook', 'tiktok',
        'cover_image', 'is_demo',
    ];

    protected $casts = ['is_demo' => 'boolean'];

    /** Profil usaha cuma satu baris. Kalau tabel masih kosong, pakai nilai aman. */
    public static function current(): self
    {
        return static::query()->first() ?? new static([
            'business_name' => 'Mandiri Laras Production',
            'is_demo' => true,
        ]);
    }

    protected function coverImageUrl(): Attribute
    {
        return Attribute::get(fn () => ImageUrl::resolve($this->cover_image, 'images/calung/calung-jadi.jpg'));
    }

    /** Nomor WA dibersihkan jadi format internasional tanpa tanda + (contoh 0812... jadi 62812...). */
    protected function whatsappDigits(): Attribute
    {
        return Attribute::get(function () {
            $digits = preg_replace('/\D+/', '', (string) $this->whatsapp_number);
            if ($digits === '') {
                return null;
            }
            if (str_starts_with($digits, '0')) {
                $digits = '62' . substr($digits, 1);
            }

            return $digits;
        });
    }

    /** Tautan wa.me dengan pesan awal. Percakapan terjadi di WhatsApp, website tidak menyimpan apa pun. */
    public function whatsappLink(?string $productName = null): ?string
    {
        if (! $this->whatsapp_digits) {
            return null;
        }

        $template = $productName
            ? ($this->whatsapp_message ?: 'Halo {usaha}, saya tertarik dengan {produk}. Apakah bisa dipesan?')
            : 'Halo {usaha}, saya mau tanya soal pesanan alat musik bambu.';
        $text = strtr($template, [
            '{usaha}' => $this->business_name,
            '{produk}' => (string) $productName,
        ]);

        return 'https://wa.me/' . $this->whatsapp_digits . '?text=' . rawurlencode($text);
    }
}
