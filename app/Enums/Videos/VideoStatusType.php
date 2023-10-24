<?php

namespace App\Enums\Videos;

use BenSampo\Enum\Enum;

/**
 * @method static static Approved()
 * @method static static Deactivated()
 */
final class VideoStatusType extends Enum
{
    //Status
    const Approved =   1; //Xuất bản
    const Deactivated =  0 ;// Nháp
}
