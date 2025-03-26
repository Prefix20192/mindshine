<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BotResource\Pages;
use App\Filament\Resources\BotResource\RelationManagers\SubscriptionsRelationManager;
use App\Models\Bot;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Forms\Components\Group;
use Filament\Forms\Set;
use Filament\Forms\Get;

class BotResource extends Resource
{
    protected static ?string $model = Bot::class;
    protected static ?string $navigationIcon = 'heroicon-o-receipt-refund';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('platform')
                    ->options([
                        'telegram' => 'Telegram',
                        'vkontakte' => 'VKontakte',
                    ])
                    ->required()
                    ->live()
                    ->default('telegram')
                    ->afterStateUpdated(function ($state, Set $set) {
                        if ($state === 'telegram') {
                            $set('version', null);
                            $set('url_handler', null);
                        }
                    }),

                TextInput::make('token')
                    ->required()
                    ->maxLength(255),

                // Поля для VK
                Group::make()
                    ->schema([
                        TextInput::make('version')
                            ->numeric()
                            ->step(0.1)
                            ->required()
                            ->visible(fn (Get $get): bool => $get('platform') === 'vkontakte'),
                    ])
                    ->visible(fn (Get $get): bool => $get('platform') === 'vkontakte')
                    ->hidden(fn (Get $get): bool => $get('platform') !== 'vkontakte')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('platform')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'telegram' => 'info',
                        'vkontakte' => 'primary',
                        default => 'gray',
                    })
                    ->searchable(),

                TextColumn::make('token')
                    ->searchable()
                    ->limit(20)
                    ->tooltip(fn (Bot $record) => $record->token),

                TextColumn::make('version')
                    ->numeric(decimalPlaces: 1)
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->visible(fn (?Bot $record) => $record?->platform === 'vkontakte'),

                TextColumn::make('latestSubscription.tariff.name')
                    ->label('Tariff')
                    ->default('No subscription')
                    ->formatStateUsing(function (?Bot $record) {
                        if (!$record || !$record->relationLoaded('latestSubscription') || !$record->latestSubscription) {
                            return 'No subscription';
                        }
                        return $record->latestSubscription->tariff->name ?? 'No tariff';
                    }),

                TextColumn::make('latestSubscription.ends_at')
                    ->label('End Date')
                    ->date()
                    ->color(function (?Bot $record): ?string {
                        if (!$record || !$record->latestSubscription || !$record->latestSubscription->ends_at) {
                            return null;
                        }
                        return $record->latestSubscription->ends_at < now() ? 'danger' : 'success';
                    }),
            ])
            ->filters([
                SelectFilter::make('platform')
                    ->options([
                        'telegram' => 'Telegram',
                        'vkontakte' => 'VKontakte',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            SubscriptionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBots::route('/'),
            'create' => Pages\CreateBot::route('/create'),
            'edit' => Pages\EditBot::route('/{record}/edit'),
        ];
    }
}
