<?php

namespace App\Enums\ActionType;

enum ActionTypeEnums: int
{
    // [VK | ЧАТЫ]
    case MESSAGE = 1;
    case PHOTO = 2;
    case REACTION = 3;
    case DELETE_MESSAGE = 4;
    case READ_MESSAGE = 5;
    // [VK | ГРУППА]
    case JOIN_GROUP = 6;
    case LEAVE_GROUP = 7;
    // [VK | ГРУППА | ПОСТЫ]
    case WALL_POST = 8;
    case WALL_CLOSE_COMMENT = 9;
    case WALL_CREATE_COMMENT = 10;
    case WALL_DELETE = 11;
    case WALL_DELETE_COMMENT = 12;
    case WALL_EDIT = 13;
    case WALL_EDIT_COMMENT = 14;
    case WALL_GET = 15;
    case WALL_GET_BY_ID = 16;
    case WALL_GET_COMMENT = 17;
    case WALL_REPOSTS = 18;
    case WALL_OPEN_COMMENT = 19;
    case WALL_PIN = 20;
    case WALL_RESTORE = 21;
    case WALL_RESTORE_COMMENT = 22;
    case WALL_SEARCH = 23;
    case WALL_UNPIN = 24;

    public function label(): string
    {
        return match ($this) {
            self::MESSAGE => 'Сообщение',
            self::PHOTO => 'Фото',
            self::REACTION => 'Реакция',
            self::DELETE_MESSAGE => 'Удаление сообщения',
            self::READ_MESSAGE => 'Прочтение сообщения',
            self::JOIN_GROUP => 'Вступление в группу',
            self::LEAVE_GROUP => 'Выход из группы',
            self::WALL_POST => 'Пост на стене',
            self::WALL_CLOSE_COMMENT => 'Закрытие комментариев',
            self::WALL_CREATE_COMMENT => 'Создание комментария',
            self::WALL_DELETE => 'Удаление поста',
            self::WALL_DELETE_COMMENT => 'Удаление комментария',
            self::WALL_EDIT => 'Редактирование поста',
            self::WALL_EDIT_COMMENT => 'Редактирование комментария',
            self::WALL_GET => 'Получение поста',
            self::WALL_GET_BY_ID => 'Получение поста по ID',
            self::WALL_GET_COMMENT => 'Получение комментария',
            self::WALL_REPOSTS => 'Репосты',
            self::WALL_OPEN_COMMENT => 'Открытие комментариев',
            self::WALL_PIN => 'Закрепление поста',
            self::WALL_RESTORE => 'Восстановление поста',
            self::WALL_RESTORE_COMMENT => 'Восстановление комментария',
            self::WALL_SEARCH => 'Поиск по стене',
            self::WALL_UNPIN => 'Открепление поста',
        };
    }

    public static function options(): array
    {
        $options = [];
        foreach (self::cases() as $case) {
            $options[$case->value] = $case->label();
        }
        return $options;
    }

    public static function getChatActionTypes(): array
    {
        return [
            self::MESSAGE->value => self::MESSAGE->label(),
            self::PHOTO->value => self::PHOTO->label(),
            self::REACTION->value => self::REACTION->label(),
            self::DELETE_MESSAGE->value => self::DELETE_MESSAGE->label(),
        ];
    }
}
