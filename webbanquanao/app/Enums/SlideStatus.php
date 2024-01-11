<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class SlideStatus extends Enum
{
    public const DANG_CHAY = 0;
    public const NGUNG_CHAY = 1;
     
    public static function getArrayView(){
        return [
            'dang ban'=> self::DANG_CHAY,
            'ngung ban'=> self::NGUNG_CHAY
        ];
    }
}
