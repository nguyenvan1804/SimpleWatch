<?php
    include "db/database.php";
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Trang quản trị Admin</h3>
    </div>
    <!--content-->
    <div class="main-content">
        <h2>Danh sách danh mục sản phẩm </h2>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th width="15px">STT</th>
                    <th width="150px">ID Danh mục</th>
                    <th>Tên Danh mục sản phẩm</th>
                    <th width="15px"></th>
                    <th width="15px"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_GET["id_category"]))
                    {
                        $id_category = $_GET['id_category'];
                        $sql = "DELETE FROM category WHERE id_category=$id_category";
                        $result = execute($sql);
                        echo '<script>alert("Đã xóa thành công!")</script>';
                        echo "<script>window.location.href='index.php?page=category_list.php'</script>";
                    }
                    // Lấy danh sách danh mục sản phẩm từ database
                    $sql = 'SELECT * FROM category'; 
                    $categoryList = executeResult($sql);
                    $index = 1;
                    foreach($categoryList as $item) : 
                ?>
            
                <tr>
                    <td><?php echo $index++; ?></td>
                    <td><?php echo $item['id_category']; ?></td>
                    <td><?php echo $item['name_category']; ?></td>
                    <td>
                        <a href="index.php?page=category_add.php&id_category=<?php echo $item['id_category'];?>" class="btn btn-warning">Sửa</a>
                    </td>
                    <td>
                        <a href="index.php?page=category_list.php&id_category=<?php echo $item['id_category'];?>" class="btn btn-danger">Xóa</a>
                    </td>
                </tr>
            </tbody>
            <?php endforeach; ?>
        </table>
    </div>
</div>

