<?php

namespace App\Enums;

enum StatusEnum: string
{
    case PENDING = 'pending';
    case COMPLETED = 'completed';
    case CANCELED = 'canceled';
   

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}