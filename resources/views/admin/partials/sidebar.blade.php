<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 d-flex">
            <div class="image">
                <img src="https://img.icons8.com/nolan/1200/user-default.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>

            <div class="info">
                <a href="#" class="d-block" data-toggle="collapse" data-target="#user-menu" aria-expanded="false"
                    aria-controls="user-menu">
                    {{ auth()->user()->name }}
                    <i class="fas fa-angle-down ml-1"></i>
                </a>
            </div>
        </div>

        <div id="user-menu" class="collapse">
            <ul class="nav nav-pills nav-sidebar flex-column">
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="fas fa-user nav-icon"></i>
                        <p>Thông tin tài khoản</p>
                    </a>
                </li>

                <li class="nav-item">
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link text-left w-100">
                            <i class="fas fa-sign-out-alt nav-icon"></i>
                            <p>Đăng xuất</p>
                        </button>
                    </form>
                </li>
            </ul>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="{{ route('admin.products.index') }}"
                        class="nav-link @if (request()->routeIs('admin.products.*')) active @endif">
                        <i class="nav-icon fas fa-box-open"></i>
                        <p>
                            Sản phẩm
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.products.index') }}"
                                class="nav-link @if (request()->routeIs('admin.products.index')) active @endif">
                                <i class="fas fa-list nav-icon"></i>
                                <p>Danh sách sản phẩm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ Route::has('admin.product.product_variant') ? route('admin.product.product_variant') : '#' }}"
                                class="nav-link @if (request()->routeIs('admin.product.product_variant')) active @endif">
                                <i class="fas fa-layer-group nav-icon"></i>
                                <p>Biến thể sản phẩm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ Route::has('admin.product.product_combo') ? route('admin.product.product_combo') : '#' }}"
                                class="nav-link">
                                <i class="fas fa-boxes nav-icon"></i>
                                <p>Combo</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ Route::has('admin.product.product_service') ? route('admin.product.product_service') : '#' }}"
                                class="nav-link">
                                <i class="fab fa-usps nav-icon"></i>
                                <p>Dịch vụ</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Users Menu -->
                <li class="nav-item">
                    <a href="#" class="nav-link @if (request()->routeIs('admin.users.*')) active @endif">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Người dùng
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ Route::has('admin.users.index') ? route('admin.users.index') : '#' }}"
                                class="nav-link @if (request()->routeIs('admin.users.index')) active @endif">
                                <i class="fas fa-list nav-icon"></i>
                                <p>Danh sách người dùng</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Settings Menu -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Cài đặt
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-toggle-on nav-icon"></i>
                                <p>Trạng thái sản phẩm</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
