<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TariffsResource\Pages;
use App\Models\Tariffs;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TariffsResource extends Resource
{
    protected static ?string $model = Tariffs::class;

    protected static ?string $navigationIcon = 'heroicon-o-receipt-refund';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

            Forms\Components\Textarea::make('description')
                ->columnSpanFull(),

            Forms\Components\TextInput::make('price')
                ->required()
                ->numeric()
                ->prefix('$'),

            Forms\Components\TextInput::make('duration_days')
                ->required()
                ->integer()
                ->label('Duration (days)'),

            Forms\Components\TextInput::make('bot_count')
                ->required()
                ->integer()
                ->default(1)
                ->label('Max Bots'),

            Forms\Components\Toggle::make('is_active')
                ->required()
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),

                Tables\Columns\TextColumn::make('duration_days')
                    ->label('Days')
                    ->sortable(),

                Tables\Columns\TextColumn::make('bot_count')
                    ->label('Bots')
                    ->sortable(),

                Tables\Columns\TextColumn::make('subscriptions_count')
                    ->counts('subscriptions')
                    ->label('Total Subs'),

                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\SelectFilter::make('is_active')
                    ->options([
                        true => 'Active',
                        false => 'Inactive',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('activate')
                    ->action(fn (Tariffs $record) => $record->update(['is_active' => true]))
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->hidden(fn (Tariffs $record) => $record->is_active),

                Tables\Actions\Action::make('deactivate')
                    ->action(fn (Tariffs $record) => $record->update(['is_active' => false]))
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->hidden(fn (Tariffs $record) => !$record->is_active),

                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListTariffs::route('/'),
            'create' => Pages\CreateTariffs::route('/create'),
            'edit' => Pages\EditTariffs::route('/{record}/edit'),
        ];
    }
}
