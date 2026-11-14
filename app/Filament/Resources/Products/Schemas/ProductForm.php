<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->label('Nama produk')->required()->maxLength(255),
                Select::make('category')->label('Kategori')
                    ->options([
                        'Alat Musik' => 'Alat Musik',
                        'Pelengkap' => 'Pelengkap',
                        'Kerajinan Bambu' => 'Kerajinan Bambu',
                    ])
                    ->required(),
                TextInput::make('price')->label('Harga (angka)')->numeric()->minValue(0)->prefix('Rp')
                    ->helperText('Kosongkan bila harga sesuai pesanan.'),
                TextInput::make('price_label')->label('Label harga (opsional)')->maxLength(255)
                    ->helperText('Contoh: Rp 60.000 / buah. Kalau diisi, label ini yang tampil.'),
                TextInput::make('lead_time')->label('Perkiraan lama pengerjaan')->maxLength(255)
                    ->placeholder('Contoh: 3 sampai 4 hari kerja'),
                Toggle::make('is_made_to_order')->label('Dibuat sesuai pesanan')->default(true),
                Toggle::make('is_featured')->label('Tampilkan di beranda')->default(false),
                TextInput::make('sort_order')->label('Urutan tampil')->numeric()->minValue(0)->default(0),
                Textarea::make('description')->label('Deskripsi singkat')->rows(3)->required()->maxLength(500)->columnSpanFull(),
                RichEditor::make('content')->label('Detail produk')->columnSpanFull(),
                FileUpload::make('image')->label('Foto produk')
                    ->image()->maxSize(2048)
                    ->disk('public')->directory('products')
                    ->helperText('JPG/PNG, maksimal 2 MB.')
                    ->columnSpanFull(),
            ]);
    }
}
