  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{ route('/dashboard')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        @can('list-category')
        <a class="nav-link collapsed" data-bs-target="#category-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Categories</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="category-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          {{-- @can('viewAny', App\Models\CategoriesModel::class) --}}
          <li>
            <a href="{{ route('list_categories')}}">
              <i class="bi bi-circle"></i><span>List Category</span>
            </a>
          </li>
          @can('add-category')
          <li>
            <a href="{{ route('form_add_categories')}}">
              <i class="bi bi-circle"></i><span>Add Category</span>
            </a>
          </li>
          @endcan
        </ul>
        @endcan
      </li><!-- End category Nav -->

      <li class="nav-item">
        @can("list-slide")
        <a class="nav-link collapsed" data-bs-target="#slides-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Slides</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="slides-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('list_slide')}}">
              <i class="bi bi-circle"></i><span>List slide show</span>
            </a>
          </li>
          @can('add-slide')
          <li>
            <a href="{{ route('form_add_slide')}}">
              <i class="bi bi-circle"></i><span>Add slide show</span>
            </a>
          </li>
          @endcan
        </ul>
        @endcan
      </li><!-- End slides Nav -->
      
      <li class="nav-item">
        @can('list-blog')
        <a class="nav-link collapsed" data-bs-target="#blogs-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Blogs</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="blogs-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('show_list_blog')}}">
              <i class="bi bi-circle"></i><span>List Blog</span>
            </a>
          </li>
          @can('add-blog')
          <li>
            <a href="{{ route('form_add_blog')}}">
              <i class="bi bi-circle"></i><span>Add Blog</span>
            </a>
          </li>
          @endcan
        </ul>
        @endcan
      </li><!-- End blogs Nav -->

      <li class="nav-item">
          @can('list-product')
          <a class="nav-link collapsed" data-bs-target="#product-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-gem"></i><span>Products</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="product-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              <a href="{{ route('list_product')}}">
                <i class="bi bi-circle"></i><span>List Product</span>
              </a>
            </li>
            @can('add-product')
            <li>
              <a href="{{ route('form_add_product')}}">
                <i class="bi bi-circle"></i><span>Add product</span>
              </a>
            </li>
            @endcan
          </ul>
          @endcan
      </li><!-- End product Nav -->

      <li class="nav-item">
          @can("list-order")
          <a class="nav-link collapsed" data-bs-target="#order-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-gem"></i><span>Quản lý đơn hàng</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="order-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              <a href="{{ route('list_order')}}">
                <i class="bi bi-circle"></i><span>Đơn hàng</span>
              </a>
            </li>
          </ul>
          @endcan
      </li><!-- End order Nav -->

      <li class="nav-heading">Configuration</li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('media')}}">
          <i class="bi bi-person"></i>
          <span>Media</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('profileUser')}}">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('list_member')}}">
          <i class="bi bi-person"></i>
          <span>Khách hàng</span>
        </a>
      </li><!-- End Guest Page Nav -->

      @can("list-setting")
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('list_setting')}}">
          <i class="bi bi-question-circle"></i>
          <span>Setting</span>
        </a>
      </li><!-- End setting Nav -->
      @endcan

      @can("list-user")
      <li class="nav-heading">Permissions</li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('list_user')}}">
          <i class="ri-file-user-line"></i>
          <span>List Nhân viên</span>
        </a>
      </li><!-- End Role Page Nav -->

      @can("list-role")
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('list_role')}}">
          <i class="ri-remote-control-line"></i>
          <span>Role</span>
        </a>
      </li><!-- End Role Page Nav -->
      @endcan

      @endcan
    </ul>

  </aside><!-- End Sidebar-->
