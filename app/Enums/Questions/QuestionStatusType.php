<?php

namespace App\Enums\Questions;

use BenSampo\Enum\Enum;

final class QuestionStatusType extends Enum
{
    //Status
    const Approved =   1; //Xuất bản
    const Deactivated =  0 ;// Nháp
}
