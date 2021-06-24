<?php

namespace App\Enums;

class Status {
    public const TO_DO = 'A fazer';
    public const IN_PROGRESS = 'Em progresso';
    public const DELAYED = 'Atrazado';
    public const DONE = 'Feito';

    public static function getStatus(string $status): string
    {
        switch ($status) {
            case 'in progress':
                return self::IN_PROGRESS;
            case 'delayed':
                return self::DELAYED;
            case 'done':
                return self::DONE;
            default:
                return self::TO_DO;
        }
    }
}
