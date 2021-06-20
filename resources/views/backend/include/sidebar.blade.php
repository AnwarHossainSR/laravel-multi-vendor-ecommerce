<!-- Sidebar Navigation-->
<nav id="sidebar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
      <div class="avatar"><img src="{{ Auth::user()->photo }}" alt="..." class="img-fluid rounded-circle"></div>
      <div class="title">
        <h1 class="h5">{{ Auth::user()->full_name }}</h1>
        <p>{{ Auth::user()->role }}</p>
      </div>
    </div>
    <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
    <ul class="list-unstyled">
            <li class="active"><a href="{{ route('home') }}"> <i class="icon-home"></i>Home </a></li>
            <li><a href="{{ route('admin') }}"> <i class="icon-grid"></i>Dashboard </a></li>
            <li><a href="#exampledropdownDropdown1" aria-expanded="false" data-toggle="collapse"> <i class="icon-picture"></i>Banner </a>
              <ul id="exampledropdownDropdown1" class="collapse list-unstyled ">
                <li><a href="{{ route('banner.index') }}">All Banners</a></li>
                <li><a href="{{ route('banner.create') }}">Create Banner</a></li>
              </ul>
            </li>
            <li><a href="#exampledropdownDropdown2" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-sitemap" style="font-size: 20px;"></i>Category </a>
                <ul id="exampledropdownDropdown2" class="collapse list-unstyled ">
                  <li><a href="{{ route('category.index') }}">All Category</a></li>
                  <li><a href="{{ route('category.create') }}">Create Category</a></li>
                </ul>
              </li>
              <li><a href="#exampledropdownDropdownBrand" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-sitemap" style="font-size: 20px;"></i>Brand </a>
                <ul id="exampledropdownDropdownBrand" class="collapse list-unstyled ">
                  <li><a href="{{ route('brand.index') }}">All Brands</a></li>
                  <li><a href="{{ route('brand.create') }}">Create Brand</a></li>
                </ul>
              </li>
              <li><a href="#exampledropdownDropdown3" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-briefcase" aria-hidden="true" style="font-size: 20px;"></i></i>Product </a>
                <ul id="exampledropdownDropdown3" class="collapse list-unstyled ">
                  <li><a href="{{ route('product.index') }}">All Product</a></li>
                  <li><a href="{{ route('product.create') }}">Create Product</a></li>
                </ul>
              </li>
              <li><a href="#exampledropdownDropdownshipping" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-car" aria-hidden="true" style="font-size: 20px;"></i></i>Shipping </a>
                <ul id="exampledropdownDropdownshipping" class="collapse list-unstyled ">
                  <li><a href="{{ route('shipping.index') }}">All Shipping</a></li>
                  <li><a href="{{ route('shipping.create') }}">Create Shipping</a></li>
                </ul>
              </li>
              <li><a href="#exampledropdownDropdown4" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-cart-plus" aria-hidden="true" style="font-size: 20px;"></i></i>Cart </a>
                <ul id="exampledropdownDropdown4" class="collapse list-unstyled ">
                  <li><a href="#">Page</a></li>
                  <li><a href="#">Page</a></li>
                  <li><a href="#">Page</a></li>
                </ul>
              </li>
              <li><a href="#exampledropdownDropdown5" aria-expanded="false" data-toggle="collapse"> <i class="icon-layers"></i>Order Manage </a>
                <ul id="exampledropdownDropdown5" class="collapse list-unstyled ">
                  <li><a href="#">Page</a></li>
                  <li><a href="#">Page</a></li>
                  <li><a href="#">Page</a></li>
                </ul>
              </li>
              <li><a href="#exampledropdownDropdown6" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-tags" aria-hidden="true"></i> </i>Post Tag </a>
                <ul id="exampledropdownDropdown6" class="collapse list-unstyled ">
                  <li><a href="#">Page</a></li>
                  <li><a href="#">Page</a></li>
                  <li><a href="#">Page</a></li>
                </ul>
              </li>
              <li><a href="#exampledropdownDropdown7" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-newspaper-o" aria-hidden="true"></i>Post </a>
                <ul id="exampledropdownDropdown7" class="collapse list-unstyled ">
                  <li><a href="#">Page</a></li>
                  <li><a href="#">Page</a></li>
                  <li><a href="#">Page</a></li>
                </ul>
              </li>
              <li><a href="#exampledropdownDropdown8" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-star" aria-hidden="true"> </i> Review </a>
                <ul id="exampledropdownDropdown8" class="collapse list-unstyled ">
                  <li><a href="#">Page</a></li>
                  <li><a href="#">Page</a></li>
                  <li><a href="#">Page</a></li>
                </ul>
              </li>
              <li><a href="#exampledropdownDropdown9" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-check-square-o" aria-hidden="true"></i> Coupon </a>
                <ul id="exampledropdownDropdown9" class="collapse list-unstyled ">
                  <li><a href="{{ route('coupon.index') }}">All Coupon</a></li>
                  <li><a href="{{ route('coupon.create') }}">Add Coupon</a></li>
                </ul>
              </li>
              <li><a href="#exampledropdownDropdown10" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-users" aria-hidden="true"></i> Users </a>
                <ul id="exampledropdownDropdown10" class="collapse list-unstyled ">
                    <li><a href="{{ route('user.index') }}">All User</a></li>
                    <li><a href="{{ route('user.create') }}">Create User</a></li>
                </ul>
              </li>
              <li><a href="#exampledropdownDropdown11" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-comments" aria-hidden="true"></i> Comments </a>
                <ul id="exampledropdownDropdown11" class="collapse list-unstyled ">
                  <li><a href="#">Page</a></li>
                  <li><a href="#">Page</a></li>
                  <li><a href="#">Page</a></li>
                </ul>
              </li>
            <li><a href="login.html"> <i class="icon-settings"></i>Settings </a></li>
            <li><a href="{{ route('logout') }}"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="icon-logout"></i>{{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            </li>
    </ul><span class="heading">Extras</span>
  </nav>
  <!-- Sidebar Navigation end-->
