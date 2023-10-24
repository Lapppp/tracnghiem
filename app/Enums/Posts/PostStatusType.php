<?php

namespace App\Enums\Posts;

use BenSampo\Enum\Enum;

/**
 * @method static static Approved()
 * @method static static Deactivated()
 */
final class PostStatusType extends Enum
{
    //Status
    const Approved =   1; //Đang hoạt động
    const Deactivated =  2 ;// Ngừng hoạt động

    // Options
    const Home =  2 ;// Xuất hiện ngoài trang chủ
    const HomeTwo =  3 ;// Xuất hiện ngoài trang chủ
    const HomeThree =  4 ;// Xuất hiện ngoài trang chủ
    const New =  1 ;// Xuất hiện cho mục tin tức mới
    const ProductHot =  5 ;// Xuất hiện cho mục tin tức mới

    //Status dành cho hồ sơ
    const Pending =   1; //Chờ duyệt hồ sơ
    const Payment_Order =  2 ;// Đề nghị thanh toán
    const Order_Confirmation =  3 ;// Xác nhận đã thanh toán
    const Success = 4 ;// Đã duyệt hồ sơ

}
