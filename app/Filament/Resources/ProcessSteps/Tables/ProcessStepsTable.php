<?php

namespace App\Filament\Resources\ProcessSteps\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProcessStepsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->columns([
                TextColumn::make('sort_order')->label('No')->sortable(),
                ImageColumn::make('image')->label('Foto')->disk('public')->square()
                    ->defaultImageUrl(asset('images/foto-menyusul.svg')),
                TextColumn::make('title')->label('Tahap')->searchable(),
                TextColumn::make('description')->label('Penjelasan')->limit(60)->wrap(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
