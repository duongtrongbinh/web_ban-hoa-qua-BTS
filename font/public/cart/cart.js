function addToCart(e) {
    e.preventDefault();
    let urlRequest = $(this).data('url');
    $.ajax({
        type: 'GET',
        url: urlRequest,
        success: function (data) {
            console.log(data);
            var itemCount = Object.keys(data).length;
            $('#cartItemCount').text(itemCount);

        },
        error: function (data) {
            if (data.code == 500) {
                console.log(data);
                // Thêm logic xử lý khi có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng ở đây
            }
        }
    });
}
function addToCartDetail(e) {
    e.preventDefault();
    let urlRequest = $(this).data('url');
    let quantity = $('.addCartProductDetail').val();
    $.ajax({
        type: 'GET',
        url: urlRequest+"/"+quantity,
        success: function (data) {
            console.log(data);
            var itemCount = Object.keys(data).length;
            $('#cartItemCount').text(itemCount);

        },
        error: function (data) {
            if (data.code == 500) {
                console.log(data);
                // Thêm logic xử lý khi có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng ở đây
            }
        }
    });
}
 function updateQuantityCart(e) {
    e.preventDefault();

    var type = $(this).data('type'); // Lấy loại sự kiện (tăng hoặc giảm)
    var requesst = $(this).data('url'); // Lấy loại sự kiện (tăng hoặc giảm)
    var input = $(this).siblings('.quantity-input'); // Lấy input số lượng tương ứng

    var currentValue = parseInt(input.val()); // Lấy giá trị hiện tại của số lượng

    // Nếu loại sự kiện là tăng và giá trị hiện tại chưa đạt giới hạn trên cùng thì tăng số lượng lên 1
    if (type === 'increase') {
        input.val(currentValue + 1).trigger('change'); // Tăng số lượng và kích hoạt sự kiện thay đổi
        $.ajax({
            type: 'GET',
            url: requesst,
            success: function (data) {
                console.log(data);
            sumCart();

            },
            error: function (data) {
                if (data.code == 500) {
                    console.log(data);
                    // Thêm logic xử lý khi có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng ở đây
                }
            }
        });
    }
    // Nếu loại sự kiện là giảm và giá trị hiện tại lớn hơn 1 thì giảm số lượng đi 1
    else if (type === 'decrease' && currentValue > 1) {
        input.val(currentValue - 1).trigger('change'); // Giảm số lượng và kích hoạt sự kiện thay đổi
        $.ajax({
            type: 'GET',
            url: requesst,
            success: function (data) {
                console.log(data);
            sumCart();

            },
            error: function (data) {
                if (data.code == 500) {
                    console.log(data);
                    // Thêm logic xử lý khi có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng ở đây
                }
            }
        });
    }
}
function removeProduct(productId) {
    $.ajax({
        type: 'GET',
        url: removeCartUrl.replace(':productId', productId),
        success: function (data) {
            var itemCount = Object.keys(data).length;
            $('#cartItemCount').text(itemCount);
            $('.cart' + productId).remove();
            sumCart();

        },
        error: function (data) {
            if (data.code == 500) {
                console.log(data);
                // Thêm logic xử lý khi có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng ở đây
            }
        }
    });
}

function sumCart(){
    
    $.ajax({
        type: 'GET',
        url: sumCartUrl,
        success: function (data) {
            console.log(data);
            var formattedPrice = parseFloat(data).toLocaleString('vi-VN', {
                style: 'currency',
                currency: 'VND'
            });
            $('.cartSumTotal').text(formattedPrice);
        },
        error: function (data) {
            if (data.code == 500) {
                console.log(data);
                // Thêm logic xử lý khi có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng ở đây
            }
        }
    });
}



$(function () {
    $(document).on('click', '.cartProduct', addToCart);
    $(document).on('click', '.cartProductDetail', addToCartDetail);
    $(document).on('click', '.change-quantity', updateQuantityCart);
});

