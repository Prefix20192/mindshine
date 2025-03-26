<?php

namespace App\Filament\Resources\BotResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class SubscriptionsRelationManager extends RelationManager
{
    protected static string $relationship = 'subscriptions';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('bot_id')
                    ->relationship('bot', 'platform')
                    ->required(),

                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),

                Forms\Components\DateTimePicker::make('starts_at')
                    ->required(),

                Forms\Components\DateTimePicker::make('ends_at')
                    ->required(),

                Forms\Components\Select::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ])
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('bot.platform')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'telegram' => 'info',
                        'vkontakte' => 'primary',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('user.name'),

                Tables\Columns\TextColumn::make('starts_at')
                    ->dateTime(),

                Tables\Columns\TextColumn::make('ends_at')
                    ->dateTime()
                    ->color(fn ($record) => $record->ends_at < now() ? 'danger' : 'success'),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'inactive' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
