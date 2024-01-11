<!DOCTYPE html>
<html>
<head>
    <title>Thông tin địa lý Việt Nam</title>
</head>
<body>
    <h1>Các tỉnh của Việt Nam</h1>
    <ul>
        @foreach($geoData as $item)
            <li>{{ $item['districts
            '] }}</li>
            <!-- Hiển thị thông tin cụ thể về từng đơn vị địa lý -->
        @endforeach
    </ul>

    {{-- <h1>Các quận của Việt Nam</h1>
    <ul>
        @foreach($geoData as $item)
            <li>{{ $item['name'] }}</li>
            <!-- Hiển thị thông tin cụ thể về từng đơn vị địa lý -->
        @endforeach
    </ul> --}}
</body>
</html>