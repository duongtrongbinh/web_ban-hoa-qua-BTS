@section('css')
  <style>
    /* Xóa mũi tên trỏ dưới của dropdown toggle */
    .dropdown-toggle::after {
        display: none !important;
    }
    .custom-dropdown-cart {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 1000; /* Đảm bảo dropdown hiển thị trên các phần tử khác */
  }


  </style>
@endsection

  <!-- header và navbar -->
    <!-- Navbar start -->
    <div class="container-fluid fixed-top">
        <div class="container topbar bg-primary d-none d-lg-block">
          <div class="d-flex justify-content-between">
            <div class="top-info ps-2">
              <small class="me-3"
                ><i class="fas fa-map-marker-alt me-2 text-secondary"></i>
                <a href="#" class="text-white">123 Street, New York</a></small
              >
              <small class="me-3"
                ><i class="fas fa-envelope me-2 text-secondary"></i
                ><a href="#" class="text-white">EmailExample.com</a></small
              >
            </div>
            <div class="top-link pe-2">
              <a href="#" class="text-white"
                ><small class="text-white mx-2">Privacy Policy</small>/</a
              >
              <a href="#" class="text-white"
                ><small class="text-white mx-2">Terms of Use</small>/</a
              >
              <a href="#" class="text-white"
                ><small class="text-white ms-2">Sales and Refunds</small></a
              >
            </div>
          </div>
        </div>
        <div class="container px-0">
          <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="{{ route('home')}}" class="navbar-brand"
              ><h1 class="text-primary display-6">Fruitables</h1></a
            >
            <button
              class="navbar-toggler py-2 px-3"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#navbarCollapse"
            >
              <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
              <div class="navbar-nav mx-auto">
                <a href="{{ route('home')}}" class="nav-item nav-link active">Home</a>
                <a href="{{ route('shop')}}" class="nav-item nav-link">Shop</a>
                {{-- > --}}
                {{-- <div class="nav-item dropdown">
                  <a
                    href="#"
                    class="nav-link dropdown-toggle"
                    data-bs-toggle="dropdown"
                    >Pages</a
                  >
                  <div class="dropdown-menu m-0 bg-secondary rounded-0">
                    <a href="cart.html" class="dropdown-item">Cart</a>
                    <a href="chackout.html" class="dropdown-item">Chackout</a>
                    <a href="testimonial.html" class="dropdown-item"
                      >Testimonial</a
                    >
                    <a href="404.html" class="dropdown-item">404 Page</a>
                  </div>
                </div> --}}
                <a href="contact.html" class="nav-item nav-link">Contact</a>
              </div>
              <div class="d-flex m-3 me-0">
                {{-- <button
                  class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4 js-show-cart">
                  <i class="fas fa-search text-primary"></i>
                </button> --}}
                
                <a class="position-relative me-4 my-auto" id="cartBtn">
                  <i class="fa fa-shopping-bag fa-2x"></i>
                  <span
                    id="cartItemCount"
                    class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                    style="top: -5px; left: 15px; height: 20px; min-width: 20px"
                    >{{ session('cart') ? count(session('cart')) : 0 }}</span
                  >
                </a>

                <ul class="nav nav-pills">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle custom-dropdown-toggle" data-bs-toggle="dropdown" href="/" role="button" aria-expanded="false">
                    <i class="fas fa-user fa-2x"></i>
                  </a>
                  @if(isset($idUser))
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('orders')}}">Đơn hàng</a></li>
                    <li><a class="dropdown-item" href="{{ route('my_account')}}">My account</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="">Logout</a></li>
                  </ul>
                  @else
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('login')}}">Login</a></li>
                  </ul>
                  @endif

                </li>
              </ul>

              </div>
            </div>
          </nav>
        </div>
      </div>
      <!-- Navbar End -->
  
      {{-- <!-- Modal Search Start -->
      <div
        class="modal fade"
        id="searchModal"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
          >
        <div class="modal-dialog modal-fullscreen">
          <div class="modal-content rounded-0">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">
                Search by keyword
              </h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body d-flex align-items-center">
              <div class="input-group w-75 mx-auto d-flex">
                <input
                  type="search"
                  class="form-control p-3"
                  placeholder="keywords"
                  aria-describedby="search-icon-1"
                />
                <span id="search-icon-1" class="input-group-text p-3"
                  ><i class="fa fa-search"></i
                ></span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal Search End --> --}}


      {{-- cart --}}
      <div id="cartOverlay">
        <div id="cartContent" style="overflow: auto;"> <!-- Thêm lớp 'overflow-auto' để phần table có thể cuộn -->
            <!-- Nội dung của giỏ hàng ở đây -->
            <div id="cartHeader" class="d-flex justify-content-between " style="padding: 10px;">
              <h2 class="text-center mb-4 mt-3" style="margin: 0;">Cart</h2>
              <i class="fas fa-times mt-4" id="closeBtn" style="cursor: pointer;top:1px;right:1px;"></i>
          </div>
            <div class="table-responsive" id="bodyCart">
                <table class="table">
                    <tbody> 

                        <!-- Thêm các dòng khác tùy thích -->
                    </tbody>
                </table>
            </div>
            <div id="cartFooter">
              <div class="text-center">
                  <button class="btn btn-danger" id="closeBtn2">Tiếp tục mua hàng</button>
                  <a href="{{ route('check')}}" class="btn btn-success" id="tt">Thanh toán <span class="cartSumTotal"></span></a>
              </div>
          </div>
        </div>

    </div>
    
    
      {{-- cart end --}}