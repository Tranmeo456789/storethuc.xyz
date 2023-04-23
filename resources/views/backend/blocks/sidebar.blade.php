<!-- sidebar: style can be found in sidebar.less -->
<!-- Brand Logo -->
<a href="" class="brand-link">
    <img src="{{asset('images/logokieu.png')}}" alt="Tdoctor" class="brand-image img-fluid">
</a>
<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item has-treeview">
                <a href="{{route('dashboard')}}" class="nav-link">
                    <i class="nav-icon fas fa-chart-line"></i>
                    <p>
                        Thống kê bán hàng
                    </p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{route('page')}}" class="nav-link">
                    <i class="nav-icon far fa-file-alt"></i>
                    <p>
                        Quản lý trang
                    </p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-file-audio"></i>
                    <p>
                        Tin tức
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('post')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danh sách bài viết</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('catPost')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danh mục bài viết</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{route('catProduct')}}" class="nav-link">
                    <i class="nav-icon far fa-folder-open"></i>
                    <p>
                        Danh mục sản phẩm
                    </p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fab fa-product-hunt"></i>
                    <p>
                        Quản lý sản phẩm
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('product.add')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Thêm mới sản phẩm</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('product')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danh sách sản phẩm</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('unit')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Đơn vị tính</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-vihara"></i>
                    <p>
                        Kho hàng
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('warehouse')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danh sách kho hàng</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('warehouse.info')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Quản lý kho</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('importCoupon')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Phiếu nhập kho</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{route('order')}}" class="nav-link">
                    <i class="nav-icon far fa-list-alt"></i>
                    <p>
                        Quản lý đơn hàng
                    </p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{route('feeShip')}}" class="nav-link">
                    <i class="fas fa-shipping-fast"></i>
                    <p>
                        Quản lý phí vận chuyển
                    </p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{route('user')}}" class="nav-link">
                    <i class="nav-icon fas fa-user-tie"></i>
                    <p>
                        Quản lý người dùng
                    </p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{route('slider')}}" class="nav-link">
                    <i class="nav-icon fas fa-sliders-h"></i>
                    <p>
                        Quản lý slider
                    </p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{route('color')}}" class="nav-link">
                    <i class="nav-icon fas fa-palette"></i>
                    <p>
                        Quản lý màu
                    </p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{route('backend.role.list')}}" class="nav-link">
                    <i class="nav-icon fab fa-gg-circle"></i>
                    <p>
                        Quản lý quyền
                    </p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-cog"></i>
                    <p>
                        Cài đặt
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('setting.infomation')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Thông tin chung</p>
                        </a>
                    </li>
                    
                </ul>
            </li>
            <li class="nav-item has-treeview">
                <a href="{{route('logout')}}" class="nav-link" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>
                        Đăng xuất
                    </p>
                </a>
            </li>
        </ul>
    </nav>
</div>
<!-- /.sidebar -->