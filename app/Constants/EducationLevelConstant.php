<?php


namespace App\Constants;


final class EducationLevelConstant {
    public const PRIMARY_SCHOOL = 'SD';
    public const JUNIOR_HIGH_SCHOOL = 'SMP';
    public const SENIOR_HIGH_SCHOOL = 'SMA';
    /*public const VOCATIONAL_HIGH_SCHOOL = 'SMK';*/
    public const UNIVERSITY = 'UNV';

    public static function allCodes(): array {
        return [
            //self::PRIMARY_SCHOOL,
            //self::JUNIOR_HIGH_SCHOOL,
            self::SENIOR_HIGH_SCHOOL,
            /*self::VOCATIONAL_HIGH_SCHOOL,*/
            //self::UNIVERSITY,
        ];
    }
}
