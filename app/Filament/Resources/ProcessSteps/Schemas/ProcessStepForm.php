<?php

namespace App\Filament\Resources\ProcessSteps\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProcessStepForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')->label('Judul tahap')->required()->maxLength(255),
                TextInput::make('sort_order')->label('Urutan')->numeric()->minValue(0)->default(0),
                Textarea::make('description')->label('Penjelasan')->rows(4)->required()->columnSpanFull(),
                FileUpload::make('image')->label('Foto')
                    ->image()->maxSize(2048)
                    ->disk('public')->directory('process')
                    ->columnSpanFull(),
            ]);
    }
}
