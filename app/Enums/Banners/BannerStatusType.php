<?php

namespace App\Enums\Banners;

use BenSampo\Enum\Enum;

/**
 * @method static static Approved()
 * @method static static Deactivated()
 */
final class BannerStatusType extends Enum
{
    //Status
    const Approved =   1; //Đang hoạt động
    const Deactivated =  2 ;// Ngừng hoạt động
}
