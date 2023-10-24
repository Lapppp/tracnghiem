<?php

namespace App\Enums\Orders;

use BenSampo\Enum\Enum;

final class OrderSourceType extends Enum
{
    const Fb = 'Facebook';
    const Youtube = 'Youtube';
    const Google = 'Google';
    const Email = 'Email';
    const Web = 'Website';
    const iOS = 'iOS';
    const Android = 'Android';
    const All = [
        self::Fb => 'Facebook',
        self::Youtube => 'Youtube',
        self::Google => 'Google',
        self::Email => 'Email',
        self::Web => 'Website',
        self::iOS => 'iOS',
        self::Android => 'Android',
    ];
}
