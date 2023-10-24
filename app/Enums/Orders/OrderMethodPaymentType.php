<?php

namespace App\Enums\Orders;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class OrderMethodPaymentType extends Enum
{
    const COD = 'COD';
    const ATM = 'ATM';
    const VISA_MASTER = 'VISA_MASTER';
    const ACS_HOMECREDIT = 'ACS_HOMECREDIT';
    const MOMO = 'MOMO';
    const All = [
        self::COD => 'Thanh toán bằng tiền mặt khi nhận hàng',
        self::ATM => 'Thanh toán qua hình thức chuyển khoản',
        self::VISA_MASTER => 'Thanh toán cà thẻ VISA / MASTER card',
        self::ACS_HOMECREDIT => 'Thanh toán qua hình thức trả góp (ACS, Home Credit)',
        self::MOMO => 'Thanh toán qua MOMO',
    ];
}
