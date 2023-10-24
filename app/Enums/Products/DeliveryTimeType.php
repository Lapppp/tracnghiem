<?php

namespace App\Enums\Products;

use BenSampo\Enum\Enum;

final class DeliveryTimeType extends Enum
{
    const DeliveryTime =  [
        1=>'4 giờ',
        2=>'8 giờ',
        3=>'12 giờ',
        4=>'24 giờ'
    ] ;

    const DeliveryTimePage =  [
        '4hours'=>'4 giờ',
        '8hours'=>'8 giờ',
        '12hours'=>'12 giờ',
        '24hours'=>'24 giờ'
    ] ;

    const DeliveryRequest =  [
        1=>'Yêu cầu nhân viên kỹ thuật giao hàng',
        2=>'Yêu cầu dịch vụ gói quà.'
    ] ;



}
