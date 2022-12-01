<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin</span>
        <!-- <h2>NWatch</h2> -->
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Hiển thị tên user -->
        <div class="user-panel mt-3 pb-3 d-flex">
            <div class="image">
            <i class="fa fa-user fa-fw"></i> 
            </div>
            <div class="info">
                <?php 
                    if(isset($_SESSION['fullname']) && $_SESSION['role']=='admin'){
                        echo $_SESSION['fullname']; 
                    }else{
                        echo "<script>alert('Bạn chưa đăng nhập!!')</script>";
                        header('Location: ../login.php');
                    }
                ?>
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

                <li class="nav-item active">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Danh mục
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="index.php?page=category_add.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Thêm danh mục</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?page=category_list.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danh sách danh mục</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item active">
                    <a class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Sản phẩm 
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="index.php?page=product_add.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm sản phẩm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?page=product_list.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách sản phẩm</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=users.php" class="nav-link">
                        <i class="nav-icon fas fa-user"></i> 
                        <p>
                            Quản lý người dùng 
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=order.php" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Quản lý đơn hàng
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=galery.php" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Quản lý hình ảnh
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=feedback.php" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Quản lý phản hồi 
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link">
                        <i class="nav-icon fas fa-signout"></i> 
                        <p>
                            Đăng xuất 
                        </p>
                    </a>
                </li>
            
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>