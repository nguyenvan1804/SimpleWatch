<?php 
    session_start();
    include('head.php');
    include('admin/db/database.php');
?>
<head><link rel="stylesheet" href="style.css"></head>
<nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
    <div class="container">
        <img style= "height: 60px;"src="images/Simple.png" alt="">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span><i id="bar" class="fas fa-bars"></i></span> <!--tao kieu cho ky hieu bar-->
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Trang chủ</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="shop.php">Sản phẩm</a>
                    <ul class="dropdown-menu">
                        <?php
                            $sql = 'SELECT * FROM category'; 
                            $categoryList = executeResult($sql);
                            // $index = 1;
                            foreach($categoryList as $item) : 
                        ?>
                        <li><a class="dropdown-item" href="shop.php#<?php echo $item['id_category'];?>"><?php echo $item['name_category'];?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="introduction.php">Giới thiệu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Liên hệ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href=""><i class="fal fa-search"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php"><i class="fal fa-shopping-bag"></i></a>
                </li>  
                <?php
                    if (isset($_SESSION ['fullname']) && $_SESSION['role'] == 'user')
                    {?>
                         
                <li class="nav-item dropdown">
                    <a class="nav-link" href="" ><i class="fal fa-user"></i><?php echo $_SESSION['fullname'];?></a>
                    <ul class="dropdown-menu" style="padding: 5px;">
                        <li style="list-style: none;">
                            <a class="dropdown-item" href="logout.php" style="font-size:15px;">
                            <i class="fa fa-sign-out fa-fw"></i>  Logout</a>
                        </li>
                    </ul>
                </li>
                        
                <?php ;}
                else
                { 
                    echo '<li class="nav-item">
                        <a class="nav-link" href="login.php"><i class="fal fa-user"></i></a>
                        </li>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>