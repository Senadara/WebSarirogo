<?php

namespace App\Filament\Resources\LandResource\Pages;

use App\Filament\Resources\LandResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLand extends EditRecord
{
    protected static string $resource = LandResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
