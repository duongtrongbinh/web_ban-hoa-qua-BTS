
// Lắng nghe sự kiện khi select tỉnh/thành phố được chọn
$('select[name="province"]').change(function() {
    var selectedProvince = $(this).val(); // Lấy giá trị đã chọn
    console.log(district.replace(':productId', selectedProvince));
    // alert(district.replace(':productId', selectedProvince));
    

    // Gửi yêu cầu AJAX để lấy dữ liệu quận/huyện từ API
    $.ajax({
        type: 'GET',
        url: district.replace(':productId', selectedProvince), // Đường dẫn tới API lấy dữ liệu quận/huyện
        success: function(data) {
            console.log(data);
            // Đổ dữ liệu vào select quận/huyện và bỏ disabled
            var districtSelect = $('select[name="district"]');
            districtSelect.empty(); // Xóa tất cả các option cũ trước khi thêm mới
            districtSelect.prop('disabled', false); // Bỏ disabled
            districtSelect.append($('<option>').text('Choose').attr('value', ''));
            $.each(data, function(key, value) {
                districtSelect.append($('<option>').text(value.DistrictName).attr('value', value.DistrictID+':'+value.DistrictName));
            });
            districtSelect.trigger('change'); // Kích hoạt sự kiện change

        },
        error: function(data) {
            console.log('Error:', data);
        }
    });
});



// Lắng nghe sự kiện khi select tỉnh/thành phố được chọn
$('select[name="district"]').change(function() {
    var selectedProvince = $(this).val(); // Lấy giá trị đã chọn
    console.log(warn.replace(':districtId', selectedProvince));
    // alert(district.replace(':productId', selectedProvince));
    

    // Gửi yêu cầu AJAX để lấy dữ liệu quận/huyện từ API
    $.ajax({
        type: 'GET',
        url: warn.replace(':districtId', selectedProvince), // Đường dẫn tới API lấy dữ liệu quận/huyện
        success: function(data) {
            console.log(data);
            // Đổ dữ liệu vào select quận/huyện và bỏ disabled
            var districtSelect = $('select[name="warn"]');
            districtSelect.empty(); // Xóa tất cả các option cũ trước khi thêm mới
            districtSelect.prop('disabled', false);             // Bỏ disabled
            districtSelect.append($('<option>').text('Choose').attr('value', ''));
            $.each(data, function(key, value) {
                districtSelect.append($('<option>').text(value.WardName).attr('value', value.WardCode+':'+value.WardName));
            });
            districtSelect.trigger('change'); // Kích hoạt sự kiện change

        },
        error: function(data) {
            console.log('Error:', data);
        }
    });
});




// Lắng nghe sự kiện khi select tỉnh/thành phố được chọn
$('select[name="warn"]').change(function() {
    var selectedProvince = $(this).val(); // Lấy giá trị đã chọn
    console.log(moneyship.replace(':id', selectedProvince));
    // alert(district.replace(':productId', selectedProvince));
    

    // Gửi yêu cầu AJAX để lấy dữ liệu quận/huyện từ API
    $.ajax({
        type: 'GET',
        url: moneyship.replace(':id', selectedProvince), // Đường dẫn tới API lấy dữ liệu quận/huyện
        success: function(data) {
            console.log(data);
            var formattedPrice = parseFloat(data.data.total).toLocaleString('vi-VN', {
                style: 'currency',
                currency: 'VND'
            });
            $('#moneyship').text(formattedPrice);
                        // Lấy giá trị của #subTo
            var moneyshipValue = parseFloat($('#subTo').text().replace(/[^0-9.-]+/g,""));
            console.log(data.data.total);
            console.log(moneyshipValue);
            // Tính toán giá trị mới cho #payMent
            var payMentValue = data.data.total + moneyshipValue;
            var Pay = parseFloat(payMentValue).toLocaleString('vi-VN', {
                style: 'currency',
                currency: 'VND'
            });
            // Cập nhật giá trị của #payMent
            $('#payMent').text(Pay);

        },
        error: function(data) {
            console.log('Error:', data);
        }
    });
});

// $('#moneyship').on('change', function() {
//     // Lấy giá trị mới của #moneyship
//     var moneyshipValue = parseFloat($(this).text().replace('VND', '').trim());
    
//     // Lấy giá trị của #subTo
//     var subToValue = parseFloat($('#subTo').text().replace('VND', '').trim());

//     // Tính toán giá trị mới cho #payMent
//     var payMentValue = moneyshipValue + subToValue;

//     // Cập nhật giá trị của #payMent
//     $('#payMent').text(numberWithCommas(payMentValue) + ' VND');
// });
