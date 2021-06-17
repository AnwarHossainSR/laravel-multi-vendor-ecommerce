<header class="header shop" id="cart-ajax-loader">
    <!-- Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                    <!-- Top Left -->
                    <div class="top-left">
                        <ul class="list-main">

                            <li><i class="ti-headphone-alt"></i>phone</li>
                            <li><i class="ti-email"></i> email</li>
                        </ul>
                    </div>
                    <!--/ End Top Left -->
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <!-- Top Right -->
                    <div class="right-content">
                        <ul class="list-main">
                        <li><i class="ti-location-pin"></i> <a href="">Track Order</a></li>
                            {{-- <li><i class="ti-alarm-clock"></i> <a href="#">Daily deal</a></li> --}}
                            @auth
                                @if(Auth::user()->role=='admin')
                                    <li><i class="ti-user"></i> <a href="{{ route('admin') }}"  target="_blank">Dashboard</a></li>
                                @elseif(Auth::user()->role=='seller')
                                    <li><i class="ti-user"></i> <a href="{{ route('seller') }}"  target="_blank">Dashboard</a></li>
                                @else
                                    <li><i class="ti-user"></i> <a href="{{ route('customer') }}"  target="_blank">Dashboard</a></li>
                                @endif
                                <li><i class="ti-power-off"></i> <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">@csrf</form>
                                </li>

                            @else
                                <li><i class="ti-power-off"></i><a href="{{ route('login') }} ">Login /</a> <a href="{{ route('register') }}">Register</a></li>
                            @endauth
                        </ul>
                    </div>
                    <!-- End Top Right -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->
    <div class="middle-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-12">
                    <!-- Logo -->
                    <div class="logo">

                        <a href="{{route('home')}}"><img src="{{ asset('frontend') }}/img/logo.png" alt="logo"></a>
                    </div>
                    <!--/ End Logo -->
                    <!-- Search Form -->
                    <div class="search-top">
                        <div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
                        <!-- Search Form -->
                        <div class="search-top">
                            <form class="search-form">
                                <input type="text" placeholder="Search here..." name="search">
                                <button value="search" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                        <!--/ End Search Form -->
                    </div>
                    <!--/ End Search Form -->
                    <div class="mobile-nav"></div>
                </div>
                <div class="col-lg-8 col-md-7 col-12">
                    <div class="search-bar-top">
                        <div class="search-bar">
                            <select>
                                <option >All Category</option>
                                {{-- @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach --}}
                            </select>
                            <form method="POST" action="">
                                @csrf
                                <input name="search" placeholder="Search Products Here....." type="search">
                                <button class="btnn" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="right-bar">
                        <!-- Search Form -->
                        <div class="sinlge-bar shopping">

                            <a href="" class="single-icon"><i class="fa fa-heart-o"></i> <span class="total-count">wishlist</span></a>
                            <!-- Shopping Item -->

                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span> Items</span>
                                        <a href="">View Wishlist</a>
                                    </div>
                                    <ul class="shopping-list">
                                        {{-- {{Helper::getAllProductFromCart()}} --}}
                                            photo
                                                    <li>
                                                       operation on wishlist
                                                    </li>
                                    </ul>
                                    <div class="bottom">
                                        <div class="total">
                                            <span>Total</span>
                                            <span class="total-amount">$455</span>
                                        </div>
                                        <a href="" class="btn animate">Cart</a>
                                    </div>
                                </div>
                            <!--/ End Shopping Item -->
                        </div>
                        {{-- <div class="sinlge-bar">
                            <a href="{{route('wishlist')}}" class="single-icon"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                        </div> --}}
                        <div class="sinlge-bar shopping">
                            <a href="" class="single-icon"><i class="fa fa-cart-plus"></i> <span class="total-count" id="cart-counter">{{ Cart::instance('shopping')->count() }}</span></a>
                            <!-- Shopping Item -->
                            @auth
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span> Items</span>
                                        <a href="{{ route('cart') }}">View Cart</a>
                                    </div>
                                    <ul class="shopping-list">
                                        @foreach (Cart::instance('shopping')->content() as $item)
                                        <li>
                                            <a href="#" class="remove cart-delete" data-id="{{ $item->rowId }}" title="Remove this item"><i class="fa fa-remove"></i></a>
                                            <a class="cart-img" href="{{ route('product-detail',$item->model->slug) }}"><img src="{{ $item->model->photo }}" alt="#"></a>
                                            <h4><a href="{{ route('product-detail',$item->model->slug) }}">{{ $item->name }}</a></h4>
                                            <p class="quantity">{{ $item->qty }} x - <span class="amount">{{ number_format($item->price,2) }}</span></p>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <div class="bottom">
                                        <div class="total">
                                            <span>Total</span>
                                            <span class="total-amount">
                                                {{ Cart::subtotal() }}
                                            </span>
                                        </div>
                                        <a href="" class="btn animate">Checkout</a>
                                    </div>
                                </div>
                            @endauth
                            <!--/ End Shopping Item -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Inner -->
    <div class="header-inner">
        <div class="container">
            <div class="cat-nav-head">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="menu-area">
                            <!-- Main Menu -->
                            <nav class="navbar navbar-expand-lg">
                                <div class="navbar-collapse">
                                    <div class="nav-inner">
                                        <ul class="nav main-menu menu navbar-nav">
                                            <li class=""><a href="{{ route('home') }}">Home</a></li>
                                            <li class=""><a href="">About Us</a></li>
                                            <li class=""><a href="">Products</a><span class="new">New</span></li>

                                            <li class=""><a href="">Blog</a></li>

                                            <li class=""><a href="">Contact Us</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                            <!--/ End Main Menu -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header>
