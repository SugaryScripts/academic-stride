<?php


namespace App\Constants;


class SessionExamStatusConstant {
    public const OPEN = 'OPEN';
    public const IN_PROGRESS = 'IN_PROGRESS';
    public const COMPLETED = 'COMPLETED';
    public const CLOSED = 'CLOSED';

    public static function allCodes(): array {
        return [
            self::OPEN,
            self::IN_PROGRESS,
            self::COMPLETED,
            self::CLOSED,
        ];
    }
}
