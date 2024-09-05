<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8" src={{asset('AdminLTE/dist/img/AdminLTELogo.png')}} >
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img class="img-circle elevation-2" alt="User Image" src={{asset('AdminLTE/dist/img/user2-160x160.jpg')}} >
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <a href="{{route('categories.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Danh Mục Sản Phẩm
                        <span class="right badge badge-danger">New</span>
                    </p>
                </a>
                <a href="{{route('menus.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Menu
                    </p>
                </a>
                <a href="{{route('product.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Sản Phẩm
                    </p>
                </a>
                <div class="item"><a class="sub-btn"><i class="fas fa-table"></i>San Pham<i class="fas fa-angle-right dropdown"></i></a>
                    <div class="sub-menu">
                        <a href="#"><div class="sub-item">Subitem1</div></a>
                        <a href="#"><div class="sub-item">Subitem1</div></a>
                    </div>
                </div>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
