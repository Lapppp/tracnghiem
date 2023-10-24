<?php

namespace App\Enums\Orders;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class OrderStatusType extends Enum
{
    const Pending = 1; // Đơn hàng mới
    const Inprocess = 2; // Đơn hàng chờ xử lý
    const Dispatched = 3; // Đơn hàng đã gởi đi
    const Complete = 4; // Đơn hàng hoàn thành
    const Return = 5; // Đơn hàng trả lại
    const Cancel = 6; // Đơn hàng hủy
    const All = [
        self::Pending => 'Đơn hàng mới',
        self::Inprocess => 'Đơn hàng chờ xử lý',
        self::Dispatched => 'Đơn hàng đã gởi đi',
        self::Complete => 'Đơn hàng hoàn thành',
        self::Return => 'Đơn hàng trả lại',
        self::Cancel => 'Đơn hàng hủy',
    ];
}
