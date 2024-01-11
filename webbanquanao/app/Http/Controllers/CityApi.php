<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CityApi extends Controller
{
    public function getGeoDataFromAPI()
    {
        $api_url = 'https://provinces.open-api.vn/api/?depth=2'; // Đường dẫn API cung cấp thông tin về địa lý VN

        try {
            $response = Http::get($api_url);

            // Kiểm tra xem yêu cầu có thành công không
            if ($response->successful()) {
                $geoData = $response->json(); // Lấy dữ liệu dạng JSON từ phản hồi

                // Truyền dữ liệu nhận được đến view để hiển thị
                return view('inde')->with('geoData', $geoData);
            } else {
                return 'Yêu cầu không thành công: ' . $response->status();
            }
        } catch (Exception $e) {
            return 'Có lỗi xảy ra: ' . $e->getMessage();
        }
    }
}
