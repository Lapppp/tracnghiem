<?php

namespace App\Enums\Tests;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TestsPosition extends Enum
{
    const New = 1;
    const Hot = 2;
    const Trend = 3;

    public static function getPosition(): array
    {
        return [
            self::New => 'Mới nhất',
            self::Hot => 'Hot',
            self::Trend => 'Xu hướng',
        ];
    }
}
