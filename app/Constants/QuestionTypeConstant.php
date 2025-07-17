<?php


namespace App\Constants;


final class QuestionTypeConstant {
    public const MULTIPLE_CHOICE_TEXT = 'MCT';
    public const ESSAY = 'ESY';

    public const REF_MASTER_QUESTION_TYPE = 'QUESTION_TYPE'; // QSTN

    public static function allCodes() {
        return [
            self::MULTIPLE_CHOICE_TEXT,
            self::ESSAY
        ];
    }
}
