<?php

namespace App\Filament\AvatarProviders;

use Filament\AvatarProviders\Contracts\AvatarProvider;
use Filament\Facades\Filament;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

/**
 * Avatar inisial yang dibuat lokal (SVG data URI), supaya panel admin
 * tidak memanggil layanan avatar luar.
 */
class InitialsAvatarProvider implements AvatarProvider
{
    public function get(Model | Authenticatable $record): string
    {
        $initials = str(Filament::getNameForDefaultAvatar($record))
            ->trim()
            ->explode(' ')
            ->filter()
            ->take(2)
            ->map(fn (string $part): string => mb_strtoupper(mb_substr($part, 0, 1)))
            ->join('');

        $initials = e($initials !== '' ? $initials : 'A');

        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64">'
            . '<rect width="64" height="64" fill="#231C20"/>'
            . '<text x="50%" y="54%" text-anchor="middle" dominant-baseline="middle" '
            . 'font-family="Inter, Arial, sans-serif" font-size="26" font-weight="600" fill="#F3EEE4">'
            . $initials . '</text></svg>';

        return 'data:image/svg+xml;base64,' . base64_encode($svg);
    }
}
