<?php

namespace App\Enums\Departments;

use BenSampo\Enum\Enum;

/**
 * @method static static Approved()
 * @method static static Deactivated()
 */
final class UsersAdminDepartmentStatusType extends Enum
{
    //Status
    const Manager =   1; //Người xử lý trưởng phòng
    const Main =   2; //Người xử lý chính
    const Sub =  3 ;// Người xử lý phụ
    const Expert = 4 ;// Người xử lý chuyên gia
}
