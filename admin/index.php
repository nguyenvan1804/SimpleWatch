<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('modules/head.php');?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <?php 
        include('modules/nav.php');
        include('modules/sidebar.php');
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <?php 
                        if(isset($_GET["page"])){
                            $page = $_GET["page"];
                            $file = "modules/".$page;
                            include($file);
                        }
                    ?>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <?php include('modules/footer.php');?>
</body>
</html>
