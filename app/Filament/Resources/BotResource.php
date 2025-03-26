<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BotResource\Pages;
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
use Illuminate\Support\Str;

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
                        } elseif ($state === 'vkontakte') {
                            $set('url_handler', url('/api/v1/vk/callback/' . Str::random(16)));
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
                            ->required()
                            ->step(0.001)
                            ->default('5.131')
                            ->visible(fn (Get $get): bool => $get('platform') === 'vkontakte'),
                    ])
                    ->visible(fn (Get $get): bool => $get('platform') === 'vkontakte')
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

                TextColumn::make('version')
                    ->numeric(decimalPlaces: 1)
                    ->default('-')
                    ->formatStateUsing(function (?string $state, Bot $record): ?string {
                        return $record->platform === 'vkontakte' ? $state : null;
                    }),

                TextColumn::make('url_handler')
                    ->label('Callback URL')
                    ->default('-')
                    ->formatStateUsing(function (?string $state, Bot $record): ?string {
                        return $record->platform === 'vkontakte' ? $state : null;
                    })
                    ->url(fn (?string $state): ?string => $state)
                    ->openUrlInNewTab()
                    ->copyable()
                    ->copyMessage('URL copied to clipboard')
                    ->tooltip(fn (?string $state): ?string => $state)
                    ->searchable(),

                TextColumn::make('latestSubscription.tariff.name')
                    ->label('Tariff')
                    ->default('No subscription')
                    ->formatStateUsing(function (?Bot $record) {
                        if (!$record?->relationLoaded('latestSubscription') || !$record->latestSubscription) {
                            return 'No subscription';
                        }
                        return $record->latestSubscription->tariff->name ?? 'No tariff';
                    }),

                TextColumn::make('latestSubscription.status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'active' => 'success',
                        'inactive' => 'danger',
                        'expired' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(function (?Bot $record) {
                        if (!$record?->latestSubscription) {
                            return 'No subscription';
                        }

                        if ($record->latestSubscription->ends_at < now()) {
                            return 'expired';
                        }

                        return $record->latestSubscription->status;
                    }),

                TextColumn::make('latestSubscription.ends_at')
                    ->label('End Date')
                    ->formatStateUsing(function ($state, Bot $record) {
                        if (!$state) {
                            return '-';
                        }
                        return $state->format('Y-m-d');
                    })
                    ->color(function (?Bot $record): ?string {
                        if (!$record?->latestSubscription?->ends_at) {
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
                SelectFilter::make('subscription_status')
                    ->label('Subscription Status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                        'expired' => 'Expired',
                    ])
                    ->query(function ($query, array $data) {
                        if (!empty($data['value'])) {
                            $status = $data['value'];
                            $query->whereHas('latestSubscription', function($q) use ($status) {
                                if ($status === 'expired') {
                                    $q->where('ends_at', '<', now());
                                } else {
                                    $q->where('status', $status);
                                }
                            });
                        }
                    })
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBots::route('/'),
            'create' => Pages\CreateBot::route('/create'),
            //'edit' => Pages\EditBot::route('/{record}/edit'),
        ];
    }
}
