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
                        <a href="{{route('product')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danh sản phẩm</p>
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
                <a href="{{route('order')}}" class="nav-link">
                <i class="nav-icon far fa-list-alt"></i>
                    <p>
                        Quản lý đơn hàng
                    </p>
                </a>
            </li>
           
        </ul>
    </nav>
</div>
<!-- /.sidebar -->