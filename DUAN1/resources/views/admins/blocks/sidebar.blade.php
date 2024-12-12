<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <div class="logo-box">
                <a class='logo logo-light' href='index.html'>
                    <span class="logo-sm">
                        <img src="{{ asset('admins/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('admins/images/logo-light.png') }}" alt="" height="24">
                    </span>
                </a>
                <a class='logo logo-dark' href='index.html'>
                    <span class="logo-sm">
                        <img src="{{ asset('admins/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('admins/images/logo-dark.png') }}" alt="" height="24">
                    </span>
                </a>
            </div>

            <ul id="side-menu">

                <li class="menu-title">Menu</li>
                <li>
                        <a class='tp-link' href='{{route('admins.statistical')}}'>
                            <i data-feather="users"></i>
                            <span> Thống kê </span>
                        </a>
                     </li>
                    <li>
                        <a class='tp-link' href='{{route('admins.users.index')}}'>
                            <i data-feather="users"></i>
                            <span> Người Dùng </span>
                        </a>
                     </li>


                <li class="menu-title">Trang Web</li>
                <li>
                    <a class='tp-link' href='{{route('admins.categories.index')}}'>
                        <i data-feather="package"></i>
                        <span> Danh Mục </span>
                    </a>
                </li>
                <li>
                    <a class='tp-link' href='{{route('admins.products.index')}}'>
                        <i data-feather="align-center"></i>
                        <span> Sản Phẩm </span>
                    </a>
                </li>
                <li>
                    <a class='tp-link' href='{{route('admins.authors.index')}}'>
                        <i data-feather="user"></i>
                        <span> Tác giả </span>
                    </a>
                </li>
                <li>
                    <a class='tp-link' href='{{route('admins.publishers.index')}}'>
                        <i data-feather="book"></i>
                        <span> Nhà xuất bản </span>
                    </a>
                </li>
                <li>
                    <a class='tp-link' href='{{route('admins.banner.index')}}'>
                        <i data-feather="book"></i>
                        <span> Banner </span>
                    </a>
                </li>
                <li>
                    <a class='tp-link' href='{{route('admins.orders.index')}}'>
                        <i data-feather="shopping-bag"></i>
                        <span> Đơn Hàng </span>
                    </a>
                </li>

            </ul>
           <ul>
            <li>
                <a class='tp-link' href='{{route('admins.anh.index')}}'>
                    <i data-feather="shopping-bag"></i>
                    <span> Mã QR Thanh Toán </span>
                </a>
            </li>
           </ul>
        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
</div>
