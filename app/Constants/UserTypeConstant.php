<?php


namespace App\Constants;


final class UserTypeConstant {
    // User Type Codes
    public const ADMIN = 'ADM';
    public const ANALYSER = 'ANL';
    public const INSTITUTION = 'INS';
    public const EDUCATOR = 'EDU';
    public const STUDENT = 'STD';

    // Other related user type constants if needed
    // public const DEFAULT_ROLE = 'student';

    // Type for ref_master_types table for these user types
    public const REF_MASTER_USER_TYPE = 'USER_TYPE';

    // Optional: A method to get all codes, useful for validation or dropdowns
    public static function allCodes(): array {
        return [
            self::STUDENT,
            self::EDUCATOR,
            self::ANALYSER,
        ];
    }
}
