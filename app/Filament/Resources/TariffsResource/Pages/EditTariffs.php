<?php

namespace App\Filament\Resources\TariffsResource\Pages;

use App\Filament\Resources\TariffsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTariffs extends EditRecord
{
    protected static string $resource = TariffsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
