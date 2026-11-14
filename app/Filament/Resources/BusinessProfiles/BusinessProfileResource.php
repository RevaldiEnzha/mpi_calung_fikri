<?php

namespace App\Filament\Resources\BusinessProfiles;

use App\Filament\Resources\BusinessProfiles\Pages\EditBusinessProfile;
use App\Filament\Resources\BusinessProfiles\Pages\ListBusinessProfiles;
use App\Filament\Resources\BusinessProfiles\Schemas\BusinessProfileForm;
use App\Models\BusinessProfile;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BusinessProfileResource extends Resource
{
    protected static ?string $model = BusinessProfile::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingStorefront;

    protected static ?string $navigationLabel = 'Profil & Kontak';

    protected static ?string $modelLabel = 'profil usaha';

    protected static ?string $pluralModelLabel = 'profil usaha';

    protected static ?int $navigationSort = 3;

    // Profil cuma satu baris, jadi tidak ada tombol tambah/hapus.
    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return BusinessProfileForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->paginated(false)
            ->columns([
                TextColumn::make('business_name')->label('Nama usaha'),
                TextColumn::make('owner_name')->label('Pemilik'),
                TextColumn::make('whatsapp_number')->label('Nomor WhatsApp'),
                TextColumn::make('updated_at')->label('Diubah')->dateTime('d M Y H:i'),
            ])
            ->recordActions([EditAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBusinessProfiles::route('/'),
            'edit' => EditBusinessProfile::route('/{record}/edit'),
        ];
    }
}
