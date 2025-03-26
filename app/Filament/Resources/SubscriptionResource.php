<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubscriptionResource\Pages;
use App\Models\Bot;
use App\Models\Subscription;
use App\Models\Tariffs;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SubscriptionResource extends Resource
{
    protected static ?string $model = Subscription::class;

    protected static ?string $navigationIcon = 'heroicon-o-receipt-refund';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\Select::make('bot_id')
                    ->relationship('bot', 'platform')
                    ->getOptionLabelFromRecordUsing(fn (Bot $record) => "{$record->platform} (#{$record->id_chat})")
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\Select::make('tariff_id')
                    ->relationship('tariff', 'name')
                    ->searchable()
                    ->preload()
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('bot.platform')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'telegram' => 'info',
                        'vkontakte' => 'primary',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('tariff.name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('starts_at')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('ends_at')
                    ->dateTime()
                    ->sortable()
                    ->color(fn (Subscription $record) => $record->ends_at < now() ? 'danger' : 'success'),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'inactive' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ]),

                Tables\Filters\SelectFilter::make('bot_id')
                    ->relationship('bot', 'platform')
                    ->label('Bot Platform'),

                Tables\Filters\SelectFilter::make('tariff_id')
                    ->relationship('tariff', 'name')
                    ->label('Tariff'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('activate')
                    ->action(fn (Subscription $record) => $record->update(['status' => 'active']))
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->hidden(fn (Subscription $record) => $record->status === 'active'),

                Tables\Actions\Action::make('deactivate')
                    ->action(fn (Subscription $record) => $record->update(['status' => 'inactive']))
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->hidden(fn (Subscription $record) => $record->status === 'inactive'),

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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubscriptions::route('/'),
            'create' => Pages\CreateSubscription::route('/create'),
            'edit' => Pages\EditSubscription::route('/{record}/edit'),
        ];
    }
}
