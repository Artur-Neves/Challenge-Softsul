<?php

namespace App\Enums;

use PhpParser\Node\Expr\Cast\String_;

enum OrderStatus: String
{
    case PENDING = 'pendente';
    case DELIVERED = 'entregue';
    case CANCELLED = 'cancelado';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
