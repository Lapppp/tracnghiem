<?php

namespace App\Enums\Modules;

use BenSampo\Enum\Enum;

/**
 * @method static static News()
 */
final class ModuleType extends Enum
{
    const News =   1; // module tin tức
    const Terms =   2; // module quy định điều khoản sử dụng
    const Research =   3; // module Nghiên cứu - Trao đổi
    const Guide = 4; //  module Hướng dẫn sử dụng
    const Document = 5; //  module Hồ sơ
    const Wisdom = 6; //  module Quản trị tài sản trí tuệ
    const Product = 7; //  module sản phẩm
    const Quiz = 8; //  module câu đố
}
