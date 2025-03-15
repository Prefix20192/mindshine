<?php

namespace App\Filament\Dashboard\Pages;

use Filament\Pages\Page;

class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Настройки';

    protected static string $view = 'filament.dashboard.pages.settings';

    protected static ?string $title = 'Настройки';
}
