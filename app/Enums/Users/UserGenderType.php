<?php

namespace App\Enums\Users;

use BenSampo\Enum\Enum;

/**
 * @method static static Male()
 * @method static static Female()
 */
final class UserGenderType extends Enum
{
    const Male =   1;//Nam
    const Female = 2; //Nữ
}
