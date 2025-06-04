<?php

namespace App\Filament\Resources;

use App\Enums\ActionType\ActionTypeEnums;
use App\Filament\Resources\CommandResource\Pages;
use App\Models\Bot;
use App\Models\Command;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CommandResource extends Resource
{
    protected static ?string $model = Command::class;
    protected static ?string $navigationIcon = 'heroicon-o-command-line';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Основные поля (всегда видны)
                Forms\Components\TextInput::make('name')
                    ->label('Название команды')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                // Выбор бота
                Forms\Components\Select::make('bot_id')
                    ->label('Бот')
                    ->options(Bot::query()->pluck('name', 'id'))
                    ->required()
                    ->live()
                    ->afterStateUpdated(fn (Forms\Set $set) => $set('chat_id', null)),

                // Выбор чата (появляется после выбора бота)
                Forms\Components\Select::make('chat_id')
                    ->label('Чат')
                    ->options(function (Forms\Get $get) {
                        if (!$get('bot_id')) {
                            return [];
                        }
                        return DB::table('bot_chat')
                            ->where('bot_id', $get('bot_id'))
                            ->join('chats', 'bot_chat.chat_id', '=', 'chats.id')
                            ->pluck('chats.name', 'chats.id')
                            ->toArray();
                    })
                    ->required()
                    ->searchable()
                    ->live()
                    ->hidden(fn (Forms\Get $get): bool => !$get('bot_id')),

                // Группа полей, которые появляются после выбора чата
                Forms\Components\Group::make()
                    ->schema([
                        // Триггер команды
                        Forms\Components\TextInput::make('command')
                            ->label('Триггер команды')
                            ->required()
                            ->maxLength(255)
                            ->helperText(new HtmlString('
                                <div class="p-3 bg-blue-50 border border-blue-100 rounded-lg text-sm">
                                    Введите слово или фразу, на которую будет реагировать бот.
                                    Например: "привет" или "команда_123"
                                </div>
                            ')),

                        // Выбор типа действия
                        Forms\Components\Select::make('action_type_code')
                            ->label('Тип действия')
                            ->options(ActionTypeEnums::getChatActionTypes())
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn (Forms\Set $set) => $set('data', null)),

                        // Динамические поля для выбранного типа действия
                        Forms\Components\Group::make()
                            ->schema(function (Forms\Get $get) {
                                $actionType = (int)$get('action_type_code');
                                $schema = [];

                                switch ($actionType) {
                                    case ActionTypeEnums::MESSAGE->value:
                                        $schema[] = self::getMessageActionSchema();
                                        break;
                                    case ActionTypeEnums::PHOTO->value:
                                        $schema[] = self::getPhotoActionSchema();
                                        break;
                                    case ActionTypeEnums::REACTION->value:
                                        $schema[] = self::getReactionActionSchema();
                                        break;
                                }

                                return $schema;
                            })
                    ])
                    ->hidden(fn (Forms\Get $get): bool => !$get('chat_id'))
            ]);
    }

    private static function getMessageActionSchema(): Forms\Components\Fieldset
    {
        return Forms\Components\Fieldset::make('message_action')
            ->label('Текстовое сообщение')
            ->schema([
                Forms\Components\Textarea::make('data.text')
                    ->label('Текст сообщения')
                    ->columnSpanFull()
            ]);
    }

    private static function getPhotoActionSchema(): Forms\Components\Fieldset
    {
        return Forms\Components\Fieldset::make('photo_action')
            ->label('Изображение')
            ->schema([
                Forms\Components\FileUpload::make('data.photo')
                    ->label('Изображение')
                    ->image()
                    ->directory('command_photos')
                    ->required()
                    ->columnSpanFull()
                    ->getUploadedFileNameForStorageUsing(
                        fn (TemporaryUploadedFile $file, Forms\Get $get): string =>
                            'cmd_'.$get('command').'_'.time().'.'.$file->extension()
                    )
            ]);
    }

    private static function getReactionActionSchema(): Forms\Components\Fieldset
    {
        return Forms\Components\Fieldset::make('reaction_action')
            ->label('Реакция')
            ->schema([
                Forms\Components\Select::make('data.reaction')
                    ->label('Тип реакции')
                    ->options([
                        'like' => 'Лайк',
                        'heart' => 'Сердце',
                        'laugh' => 'Смех',
                        'wow' => 'Удивление',
                        'sad' => 'Грусть',
                        'angry' => 'Злость'
                    ])
                    ->required()
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('bot.name')
                ->label('Бот')
                ->sortable(),

            TextColumn::make('chat.name')
                ->label('Чат')
                ->sortable(),

            TextColumn::make('name')
                ->label('Название')
                ->searchable(),

            TextColumn::make('command')
                ->label('Команда')
                ->searchable(),

            TextColumn::make('action_type_label')
                ->label('Тип действия')
                ->badge(),
        ])
        ->filters([
            SelectFilter::make('bot_id')
                ->label('Бот')
                ->options(Bot::query()->pluck('name', 'id'))
                ->searchable(),

            SelectFilter::make('action_type_code')
                ->label('Тип действия')
                ->options(ActionTypeEnums::options()),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCommands::route('/'),
            'create' => Pages\CreateCommand::route('/create'),
            'edit' => Pages\EditCommand::route('/{record}/edit'),
        ];
    }
}
