<?php

namespace App\Filament\Resources\ProcessSteps\Pages;

use App\Filament\Resources\ProcessSteps\ProcessStepResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProcessStep extends CreateRecord
{
    protected static string $resource = ProcessStepResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
