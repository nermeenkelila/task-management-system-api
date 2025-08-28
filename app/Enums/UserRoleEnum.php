<?php

namespace App\Enums;

enum UserRoleEnum: string
{
    case MANAGER = 'manager';
    case USER = 'user';
   

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}