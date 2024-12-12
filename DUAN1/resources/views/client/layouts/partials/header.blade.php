        <!-- header-top-area-start -->
        <div class="header-top-area">
            
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="language-area">

                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="account-area text-end">
                            <ul>
                                <li><a href="{{ route('ShowFormMyAcc') }}">Tài Khoản Của Tôi</a></li>
                                {{-- <li><a href="">Thanh toán</a></li> --}}
                                <li><a @if (Auth::check()) <span>Xin chào, {{ Auth::user()->name }} | </span>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                @else
                                    <!-- Nếu người dùng chưa đăng nhập -->
                                    <a href="{{ route('login') }}">Đăng nhập</a> @endif
                                        </a></li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header-top-area-end -->
        <!-- header-mid-area-start -->
        <div class="header-mid-area ptb-40">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-5 col-12">
                        <div class="header-search">
                            <form action="{{route('searchProducts')}}" method="GET" class="input-group">
                                @csrf
                                <input type="text" name="search" value="{{ old('search') }}" class="form-control"
                                    placeholder="Nhập Tên Tìm kiếm..." aria-label="search"
                                    aria-describedby="button-search">
                                <button class="btn btn-warning" type="submit" id="button-search">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>

                    </div>
                    <div class="col-lg-6 col-md-4 col-12">
                        <div class="logo-area text-center logo-xs-mrg">
                            <a href=" {{route('index') }}"><img src="/client/img/logo/logo.png" alt="logo" /></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-12">
                        <div class="my-cart">
                            <ul>
                                <li><a href="{{route('listCart')}}"><i class="fa fa-shopping-cart"></i>Giỏ Hàng</a>
                                    {{-- <div class="mini-cart-sub">
                                        <div class="cart-product">
                                            <div class="single-cart">
                                                <div class="cart-img">
                                                    <a href="#"><img src="/client/img/product/1.jpg"
                                                            alt="book" /></a>
                                                </div>
                                                <div class="cart-info">
                                                    <h5><a href="#">Joust Duffle Bag</a></h5>
                                                    <p>1 x £60.00</p>
                                                </div>
                                                <div class="cart-icon">
                                                    <a href="#"><i class="fa fa-remove"></i></a>
                                                </div>
                                            </div>
                                            <div class="single-cart">
                                                <div class="cart-img">
                                                    <a href="#"><img src="/client/img/product/3.jpg"
                                                            alt="book" /></a>
                                                </div>
                                                <div class="cart-info">
                                                    <h5><a href="#">Chaz Kangeroo Hoodie</a></h5>
                                                    <p>1 x £52.00</p>
                                                </div>
                                                <div class="cart-icon">
                                                    <a href="#"><i class="fa fa-remove"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cart-totals">
                                            <h5>Total <span>£12.00</span></h5>
                                        </div>
                                        <div class="cart-bottom">
                                            <a class="view-cart" href="">Xem giỏ hàng</a>
                                            <a href="">Thanh toán</a>
                                        </div>
                                    </div> --}}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header-mid-area-end -->
        <!-- main-menu-area-start -->
        <div class="main-menu-area d-md-none d-none d-lg-block sticky-header-1" id="header-sticky">
            <div class="container">
                <div class="row">
                    <div class="box-content">
                    <div class="col-lg-12">
                        <div class="menu-area">
                            <nav>
                                <ul>
                                    <li class=""><a href="{{ route('index') }} ">Trang chủ</a>
                                    </li>
                                    <li><a href="{{route('productPopulation')}}">Cửa hàng<i class="fa fa-angle-down"></i></a>

                                        <div class="mega-menu">

                                            <span>
                                                @foreach ($categories as $item)
                                                <a href="{{Route('byCategory', $item->id)}}">{{$item->name}}</a>
                                                @endforeach

                                            </span>
                                        </div>
                                    </li>

                                </ul>
                            </nav>
                        </div>
                        <div class="safe-area">
                            <a href="#">Liên hệ</a>

                        </div>
                        <div class="safe-area">
                            <a href="{{route('abc')}}">Chính sách</a>

                        </div>
                        <div class="safe-area">
                            <a href="#">Chương trình</a>

                        </div>

                    </div>
                </div>
                </div>
            </div>
        </div>
        <!-- main-menu-area-end -->
