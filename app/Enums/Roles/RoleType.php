<?php

namespace App\Enums\Roles;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class RoleType extends Enum
{
    const ceo =   'ceo';
    const customer_care_staff = 'cham-soc-khach-hang';
    const manager =   'truong-phong';
    const employee_main = 'nhan-vien-phu-trach-chinh';
    const employee_sub =   'nhan-vien-phu';
}
