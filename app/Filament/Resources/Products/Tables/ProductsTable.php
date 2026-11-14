<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->columns([
                ImageColumn::make('image')->label('Foto')->disk('public')->square()
                    ->defaultImageUrl(asset('images/foto-menyusul.svg')),
                TextColumn::make('name')->label('Nama')->searchable()->sortable(),
                TextColumn::make('category')->label('Kategori')->badge()->sortable(),
                TextColumn::make('formatted_price')->label('Harga'),
                TextColumn::make('lead_time')->label('Pengerjaan')->toggleable(),
                IconColumn::make('is_featured')->label('Beranda')->boolean(),
                TextColumn::make('sort_order')->label('Urutan')->sortable(),
                TextColumn::make('updated_at')->label('Diubah')->dateTime('d M Y H:i')->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category')->label('Kategori')->options([
                    'Alat Musik' => 'Alat Musik',
                    'Pelengkap' => 'Pelengkap',
                    'Kerajinan Bambu' => 'Kerajinan Bambu',
                ]),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
