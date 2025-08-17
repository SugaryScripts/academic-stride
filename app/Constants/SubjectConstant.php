<?php


namespace App\Constants;


class SubjectConstant {
    public const MATHEMATICS = 'MATH';
    public const ENGLISH = 'ENG';
    public const INDONESIAN = 'IND';

    public const SCIENCE = 'IPA';
    private const SCIENCE_SUB = self::SCIENCE . '-';
    public const PHYSICS = self::SCIENCE_SUB.'FISIKA';
    public const CHEMISTRY = self::SCIENCE_SUB.'KIMIA';

    public const SOCIAL = 'IPS';
    private const SOCIAL_SUB = self::SOCIAL . '-';
    public const SOCIOLOGY = self::SOCIAL_SUB.'SOSIOG';
    public const GEOGRAPHY = self::SOCIAL_SUB.'GEOGGI';
    public const ECONOMY = self::SOCIAL_SUB.'EKONMI';
    public const HISTORY = self::SOCIAL_SUB.'SEJARH';
    public const ANTHROPOLOGY = self::SOCIAL_SUB.'ANTRGI';

    public static function allCodes(): array {
        return [
            self::MATHEMATICS,
            self::ENGLISH,
            self::INDONESIAN,
            self::PHYSICS,
            self::CHEMISTRY,
            self::SOCIOLOGY,
            self::GEOGRAPHY,
            self::ECONOMY,
            self::HISTORY,
            self::ANTHROPOLOGY,
        ];
    }
}
