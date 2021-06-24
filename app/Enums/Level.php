<?php

namespace App\Enums;

class Level {
    public const NONE = 'Nenhuma';
    public const LOW = 'Baixa';
    public const AVERAGE = 'Média';
    public const HIGH = 'Alta';
    public const VERY_HIGH = 'Muito Alta';

    public static function informationLevel(int $level): string
    {
        switch ($level) {
            case 2:
                return self::LOW;
            case 3:
                return self::AVERAGE;
            case 4:
                return self::HIGH;
            case 5:
                return self::VERY_HIGH;
            default:
                return self::NONE;
        }
    }
}
