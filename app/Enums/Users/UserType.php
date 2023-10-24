<?php

namespace App\Enums\Users;

use BenSampo\Enum\Enum;

/**
 * @method static static Approved()
 * @method static static Deactivated()
 */
final class UserType extends Enum
{
    const Approved =   1; //Đang hoạt động
    const Deactivated =   0;// Ngừng hoạt động
}
