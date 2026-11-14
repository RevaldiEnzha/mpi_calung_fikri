<?php

namespace Database\Seeders;

use App\Models\BusinessProfile;
use App\Models\ProcessStep;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * DATA UJI untuk demo internal Laras Digital Studio.
 * Nama produk, harga, dan proses diambil dari wawancara dengan pemilik usaha (16 Sep 2026).
 * Nomor WhatsApp masih nomor uji. Ganti lewat halaman admin sebelum dipakai sungguhan.
 */
class DatabaseSeeder extends Seeder
{
    /** Salin foto bawaan ke disk "public" supaya sama dengan foto unggahan admin (bisa diganti/dihapus dari admin). */
    private function seedImage(string $file, string $dir): string
    {
        $dest = $dir . '/' . $file;
        Storage::disk('public')->put($dest, file_get_contents(public_path('images/calung/' . $file)));

        return $dest;
    }

    public function run(): void
    {
        BusinessProfile::query()->delete();
        BusinessProfile::create([
            'business_name' => 'Mandiri Laras Production',
            'owner_name' => 'Tegar Putra Anugrah',
            'tagline' => 'Calung dan angklung bambu wulung, dibuat sesuai pesanan.',
            'about' => "Mandiri Laras Production adalah usaha pembuatan alat musik bambu milik Pak Tegar Putra Anugrah di Desa Kemutug Lor, Baturraden, Banyumas. Pak Tegar awalnya ikut bekerja di perajin lain, lalu sejak 2011 membuat calung, angklung, dan kerajinan bambu dengan usahanya sendiri.\n\nSemua alat dibuat sesuai pesanan. Bambunya bambu wulung yang dikeringkan secara alami, lalu nada tiap bilah dicek memakai tuner. Pesanan datang dari perorangan, kelompok kesenian, sampai pedagang, dan sudah dikirim hingga ke luar Pulau Jawa.",
            'address' => 'Desa Kemutug Lor, Kec. Baturraden, Kab. Banyumas, Jawa Tengah',
            'since_year' => '2011',
            'whatsapp_number' => '6280000000000',
            'whatsapp_message' => 'Halo {usaha}, saya tertarik dengan {produk}. Apakah bisa dipesan?',
            'instagram' => null,
            'facebook' => null,
            'tiktok' => null,
            'cover_image' => $this->seedImage('calung-jadi.jpg', 'profil'),
            'is_demo' => true,
        ]);

        Product::query()->delete();
        $products = [
            [
                'name' => 'Calung Banyumasan',
                'category' => 'Alat Musik',
                'price' => 800000,
                'price_label' => null,
                'description' => 'Calung khas Banyumas untuk mengiringi lengger dan kesenian daerah. Bilah bambu wulung dengan nada yang dicek memakai tuner.',
                'content' => '<p>Calung dibuat satu per satu sesuai pesanan. Bilah dari bambu wulung yang dikeringkan alami, dirangkai pada rangka kayu.</p><ul><li>Harga di atas untuk pembelian langsung.</li><li>Untuk pedagang atau pembelian banyak, tanyakan harga lewat WhatsApp.</li><li>Nada bisa disesuaikan dengan kebutuhan lagu, sampaikan saat memesan.</li></ul>',
                'image' => $this->seedImage('calung-jadi.jpg', 'products'),
                'lead_time' => 'Dikonfirmasi saat pemesanan',
                'is_featured' => true,
            ],
            [
                'name' => 'Set Angklung Standar 18 Nada',
                'category' => 'Alat Musik',
                'price' => 850000,
                'price_label' => null,
                'description' => 'Paket angklung 18 nada yang siap dimainkan, cocok untuk sekolah, sanggar, dan kelompok kesenian.',
                'content' => '<p>Set lengkap dengan perlengkapannya, tinggal dimainkan.</p><ul><li>Harga di atas untuk pemakai langsung. Harga untuk dijual kembali berbeda, tanyakan lewat WhatsApp.</li><li>Nada dicek satu per satu memakai tuner.</li></ul>',
                'image' => null,
                'lead_time' => '3 sampai 4 hari kerja',
                'is_featured' => true,
            ],
            [
                'name' => 'Gentong Calung',
                'category' => 'Pelengkap',
                'price' => 60000,
                'price_label' => 'Rp 60.000 / buah',
                'description' => 'Pelengkap set calung. Dijual per buah, satu pasang berisi dua buah.',
                'content' => '<p>Bisa dipesan bersama calung atau terpisah.</p>',
                'image' => null,
                'lead_time' => 'Dikonfirmasi saat pemesanan',
                'is_featured' => false,
            ],
            [
                'name' => 'Jam Dinding Rangka Angklung',
                'category' => 'Kerajinan Bambu',
                'price' => null,
                'price_label' => null,
                'description' => 'Jam dinding dengan hiasan rangka angklung dari bambu, cocok untuk suvenir dan dekorasi.',
                'content' => '<p>Dibuat sesuai pesanan. Ukuran dan harga disepakati lewat WhatsApp.</p>',
                'image' => null,
                'lead_time' => 'Dikonfirmasi saat pemesanan',
                'is_featured' => true,
            ],
            [
                'name' => 'Kursi dan Meja Bambu',
                'category' => 'Kerajinan Bambu',
                'price' => null,
                'price_label' => null,
                'description' => 'Kursi dan meja dari bambu, dibuat sesuai ukuran yang dipesan.',
                'content' => '<p>Sampaikan ukuran dan jumlah yang diinginkan lewat WhatsApp.</p>',
                'image' => null,
                'lead_time' => 'Dikonfirmasi saat pemesanan',
                'is_featured' => false,
            ],
            [
                'name' => 'Kursi Males Bambu',
                'category' => 'Kerajinan Bambu',
                'price' => null,
                'price_label' => null,
                'description' => 'Kursi santai dari bambu untuk teras atau ruang keluarga.',
                'content' => '<p>Dibuat sesuai pesanan.</p>',
                'image' => null,
                'lead_time' => 'Dikonfirmasi saat pemesanan',
                'is_featured' => false,
            ],
        ];
        foreach ($products as $i => $row) {
            Product::create($row + ['is_made_to_order' => true, 'sort_order' => $i + 1]);
        }

        ProcessStep::query()->delete();
        $steps = [
            ['title' => 'Memilih bambu wulung', 'description' => 'Bambu wulung diambil dari sekitar desa dan dari daerah Gunung Tugel, lalu dikeringkan secara alami, bukan dioven, supaya tidak mudah rusak.', 'image' => $this->seedImage('stok-bambu.jpg', 'process')],
            ['title' => 'Memotong bilah', 'description' => 'Bambu dipotong menjadi bilah sesuai panjang nada. Bagian bawah disisakan kira-kira dua jari untuk kaki bilah.', 'image' => $this->seedImage('bilah-dipotong.jpg', 'process')],
            ['title' => 'Menyetel nada', 'description' => 'Setiap bilah dicek dan disetel memakai tuner sampai nadanya pas.', 'image' => $this->seedImage('setel-nada.jpg', 'process')],
            ['title' => 'Merangkai', 'description' => 'Bilah yang sudah pas dirangkai pada rangka kayu dan diikat rapi.', 'image' => $this->seedImage('bilah-dan-rangka.jpg', 'process')],
            ['title' => 'Siap dikirim', 'description' => 'Alat dicek ulang sebelum diserahkan. Pengiriman ke luar Pulau Jawa memakai jasa kargo.', 'image' => $this->seedImage('calung-jadi.jpg', 'process')],
        ];
        foreach ($steps as $i => $row) {
            ProcessStep::create($row + ['sort_order' => $i + 1]);
        }

        // Akun admin demo. Kata sandi diambil dari .env (ADMIN_PASSWORD); kalau kosong dibuat acak dan ditampilkan sekali.
        $email = config('app.admin_email');
        $password = env('ADMIN_PASSWORD');
        if (blank($password)) {
            $password = Str::password(12, symbols: false);
            $this->command?->warn("Kata sandi admin dibuat acak: {$password} (simpan, lalu ganti lewat .env bila perlu)");
        }
        User::updateOrCreate(
            ['email' => $email],
            ['name' => 'Admin Mandiri Laras', 'password' => Hash::make($password)],
        );
    }
}
