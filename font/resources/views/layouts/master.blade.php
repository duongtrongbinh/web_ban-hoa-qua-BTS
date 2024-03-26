<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Fruitables - Vegetable Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="keywords" />
    <meta content="" name="description" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap"
      rel="stylesheet"
    />

    <!-- Icon Font Stylesheet -->
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
      rel="stylesheet"
    />

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    
    {{-- css --}}
    @yield('css')
    <style>
   #cartHeader {
    position: sticky;
    top: 0;
    background-color: #e5cfcf;
    padding: 20px;
    z-index: 9999; 
}

#cartFooter {
    position: sticky;
    bottom: 0;
    background-color: #e5cfcf;
    padding: 20px;
    z-index: 9999; 
}
      #cartOverlay {
      z-index: 9999;
      position: fixed;
      top: 0;
      right: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      display: none;
    }

    #cartContent {
      z-index: 9998;
      position: fixed;
      top: 0;
      right: -100%; /* Ẩn div ngoài màn hình ban đầu */
      width: 35%; /* Chiều rộng của div */
      height: 100%;
      background-color: white;
      transition: right 0.5s ease-in-out; /* Hiệu ứng chuyển động */
    }
    #bodyCart{
      padding: 20px;
    }

    #cartContent.open {
      right: 0; /* Hiển thị div từ trái ra phải */
    }
    </style>
    {{-- end css --}}

  </head>

  <body>
    <!-- Spinner Start -->
    <div
      id="spinner"
      class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50 d-flex align-items-center justify-content-center"
    >
      <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


{{-- header --}}
    @include('layouts.header')
{{-- end header --}}

{{-- content --}}
    @yield('content')
{{-- end content --}}

{{-- footer --}}
    @include("layouts.footer")
{{-- end-footer --}}

    <!-- Back to Top -->
    <a
      href="#"
      class="btn btn-primary border-3 border-primary rounded-circle back-to-top"
      ><i class="fa fa-arrow-up"></i
    ></a>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('cart/cart.js')}}"></script>


    {{-- js --}}
    @yield('js')
    {{-- end js --}}
    <script>sumCart
      var removeCartUrl = "{{ route('removeCart', ':productId') }}";
      var sumCartUrl = "{{ route('sumCart') }}";
  </script>
    <script>
      const cartBtn = document.getElementById("cartBtn");
      const cartOverlay = document.getElementById("cartOverlay");
      const cartContent = document.getElementById("cartContent");
      const closeBtn = document.getElementById("closeBtn");
      const closeBtn2 = document.getElementById("closeBtn2");
      
    
      cartBtn.addEventListener("click", function () {
        cartOverlay.style.display = "block";
        setTimeout(function () {
          cartContent.classList.add("open"); // Thêm class 'open' để hiển thị div
        }, 100);
        $.ajax({
                type: 'GET',
                url: '{{ route("carts") }}', // Đường dẫn đến route xử lý hiển thị giỏ hàng
                success: function(response) {
                    var cartHtml = response.html;
                    $('#cartOverlay .table tbody').html(cartHtml);
            sumCart();

      }
            });
             // Đợi 0.1s trước khi hiện div

      });
    
      closeBtn.addEventListener("click", function () {
        cartContent.classList.remove("open"); // Loại bỏ class 'open' để ẩn div
        setTimeout(function () {
          cartOverlay.style.display = "none";
        }, 500); // Đợi 0.5s trước khi ẩn div
      });
      closeBtn2.addEventListener("click", function () {
        cartContent.classList.remove("open"); // Loại bỏ class 'open' để ẩn div
        setTimeout(function () {
          cartOverlay.style.display = "none";
        }, 500); // Đợi 0.5s trước khi ẩn div
      });
      // Khi người dùng nhấp vào overlay, div sẽ ẩn đi
      cartOverlay.addEventListener("click", function (event) {
        if (event.target === cartOverlay) {
          // Kiểm tra xem người dùng có nhấp vào overlay không
          cartContent.classList.remove("open"); // Loại bỏ class 'open' để ẩn div
          setTimeout(function () {
            cartOverlay.style.display = "none";
          }, 500);
          // console.log(route('mycart'));
           // Đợi 0.5s trước khi ẩn div
        }
      });
    </script>
  </body>
</html>
