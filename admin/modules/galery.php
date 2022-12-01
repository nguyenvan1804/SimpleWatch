<?php
    include "db/database.php";
    //phân trang
    $gallery = mysqli_query($conn,"SELECT * FROM galery"); 
    $total = mysqli_num_rows($gallery);  //Tính tổng số bảng ghi
    $limit = 20; //Thiết lập số bảng ghi trên 1 trang
    $page = ceil($total/$limit);//Tính số trang
    //Lấy trang hiện tại
    $cr_page = (isset($_GET['_page'])?$_GET['_page'] : 1);
    //Tính start
    $start = ($cr_page - 1)*$limit;
    //query sử dụng limit

?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Trang quản trị Admin</h3>
    </div>
    <!--content-->
    <div class="main-content">
        <h2>Ảnh mô tả sản phẩm</h2>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th width="15px">STT</th>
                    <th>Ảnh mô tả</th>
                    <th>Tên sản phẩm</th>
                    <th width="15px"></th>
                    <!-- <th width="15px"></th> -->
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_GET["id_galery"]))
                    {
                        $id_galery = $_GET['id_galery'];
                        $sql = "DELETE FROM galery WHERE id_galery=$id_galery";
                        $result = execute($sql);
                        echo '<script>alert("Đã xóa thành công!")</script>';
                        echo "<script>window.location.href='index.php?page=galery.php'</script>";
                    }
                    // Lấy danh sách danh mục sản phẩm từ database
                    $sql = "SELECT galery.id_galery, galery.images, product.title FROM galery LEFT OUTER JOIN product ON galery.product_id = product.id_product LIMIT $start,$limit"; 
                    $galeryList = executeResult($sql);
                    $index = 1;
                    foreach($galeryList as $item) : 
                ?>
            
                <tr>
                    <td><?php echo $index++; ?></td>
                    <td><img style="width:150px; max-height:150px;" src="../images/<?php echo $item['images'];?>"/></td>
                    <td><?php echo $item['title']; ?></td>
                    
                    <td>
                        <a href="index.php?page=galery.php&id_galery=<?php echo $item['id_galery'];?>" class="btn btn-danger">Xóa</a>
                    </td>
                </tr>
            </tbody>
            <?php endforeach; ?>
        </table>
    </div>
    <!-- <div class="card"> -->
        <!-- <div class="card-header">
        <h3 class="card-title">
            <i class="ion ion-clipboard mr-1"></i>
            To Do List
        </h3> -->

        <div class="card-tools">
            <ul class="pagination pagination">
            <li class="page-item"><a href="index.php?page=galery.php&_page=<?php echo $cr_page - 1;?>" class="page-link">&laquo;</a></li>
            <?php for ($i=1; $i <= $page; $i++) {  ?>
                    <li class="page-item"><a href="index.php?page=galery.php&_page=<?php echo $i;?>" class="page-link"><?php echo $i;?></a></li>
            <?php ;};?>
            
            <li class="page-item"><a href="index.php?page=galery.php&_page=<?php echo $cr_page + 1;?>" class="page-link">&raquo;</a></li>
            </ul>
        </div>
    <!-- </div> -->
</div>
