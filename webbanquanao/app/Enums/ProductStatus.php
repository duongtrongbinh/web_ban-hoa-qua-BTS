<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ProductStatus extends Enum
{
    const DANG_BAN = 0;
    const NGUNG_BAN = 1;
    const LUU_KHO = 2;
    public static function getArrStatus(){
        return [
            'đang bán'=> self::DANG_BAN,
            'ngưng bán'=> self::NGUNG_BAN,
            'lưu kho'=> self::LUU_KHO
        ];
    }
}
