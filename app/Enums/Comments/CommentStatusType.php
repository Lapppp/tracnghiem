<?php

namespace App\Enums\Comments;

use BenSampo\Enum\Enum;

final class CommentStatusType extends Enum
{
    //Status
    const Approved =   1; //Cho hiển thị đánh giá
    const Deactivated =  0 ;// Không cho hiện thị đánh giá
}
