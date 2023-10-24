<?php

namespace App\Enums\Users;

use BenSampo\Enum\Enum;

/**
 * @method static static Approved()
 * @method static static Deactivated()
 */
final class ExpiryDateType extends Enum
{
    const Days_haft_month =   15; //15 ngày
    const Days_month =   30;
    const Days_three_months =   90;
    const Days_six_months =   180;
    const Days_nine_months =   270;
    const Days_year = 365;

    /**
     * @return string[]
     */
    public static function getExpiryDate(): array
    {
        return [
            self::Days_haft_month=>'VIP 15 Days',
            self::Days_month=>'VIP 30 Days',
            self::Days_three_months=>'VIP 90 Days',
            self::Days_six_months=>'VIP 180 Days',
            self::Days_nine_months=>'VIP 270 Days',
            self::Days_year=>'VIP 365 Days',
        ];

    }
}
