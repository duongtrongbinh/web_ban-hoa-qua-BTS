<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class StatusBill extends Enum
{
    const status1 = "Đã đặt hàng";
    const status2 = "Đã thanh toán";
    const status3 = "Đã giao cho đơn vị vận chuyển";
    const status4 = "Đang trên đường giao đến bạn";
    const status5 = "Giao hàng thành công";
    const status6 = "Đã nhận được hàng";
    const status7 = "Trả hàng về người bán";
    const status8 = "Đã hủy";


    
    // Phương thức để lấy danh sách các giá trị
    public static function values()
    {
        return [
            self::status1,
            self::status2,
            self::status3,
            self::status4,
            self::status5,
            self::status6,
            self::status7,
            self::status8
        ];
    }
}