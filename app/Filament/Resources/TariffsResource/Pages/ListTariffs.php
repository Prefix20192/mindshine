<?php

namespace App\Filament\Resources\TariffsResource\Pages;

use App\Filament\Resources\TariffsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTariffs extends ListRecords
{
    protected static string $resource = TariffsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
