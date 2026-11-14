<?php

namespace App\Filament\Resources\BusinessProfiles\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BusinessProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Profil usaha')
                    ->columns(2)
                    ->schema([
                        TextInput::make('business_name')->label('Nama usaha')->required()->maxLength(255),
                        TextInput::make('owner_name')->label('Nama pemilik')->maxLength(255),
                        TextInput::make('tagline')->label('Slogan singkat')->maxLength(255)->columnSpanFull(),
                        Textarea::make('about')->label('Tentang usaha')->rows(6)
                            ->helperText('Pisahkan paragraf dengan satu baris kosong.')->columnSpanFull(),
                        TextInput::make('address')->label('Alamat')->maxLength(255)->columnSpanFull(),
                        TextInput::make('since_year')->label('Berdiri sejak (tahun)')->numeric()->minValue(1900)->maxValue(2100),
                        FileUpload::make('cover_image')->label('Foto utama beranda')
                            ->image()->maxSize(2048)->disk('public')->directory('profil'),
                    ]),
                Section::make('Kontak')
                    ->columns(2)
                    ->schema([
                        TextInput::make('whatsapp_number')->label('Nomor WhatsApp')
                            ->tel()->required()->maxLength(20)
                            ->regex('/^(\+?62|0)[0-9]{8,14}$/')
                            ->validationMessages(['regex' => 'Gunakan format 08xxxxxxxxxx atau 628xxxxxxxxxx.'])
                            ->helperText('Contoh: 081234567890. Saat demo pakai nomor uji.'),
                        TextInput::make('whatsapp_message')->label('Pesan awal WhatsApp')->maxLength(255)
                            ->helperText('Gunakan {usaha} dan {produk} sebagai isian otomatis.'),
                        TextInput::make('instagram')->label('Tautan Instagram')->url()->maxLength(255),
                        TextInput::make('facebook')->label('Tautan Facebook')->url()->maxLength(255),
                        TextInput::make('tiktok')->label('Tautan TikTok')->url()->maxLength(255),
                        Toggle::make('is_demo')->label('Tampilkan label "versi demo"')->default(true),
                    ]),
            ]);
    }
}
