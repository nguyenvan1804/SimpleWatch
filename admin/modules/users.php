<?php
    include "db/database.php";
?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Trang quản trị Admin</h3>
    </div>
    <!--content-->
    <div class="main-content">
        <h2>Quản lý người dùng </h2>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>ID_User</th>
                    <th>Họ Tên </th>
                    <th>Email</th>
                    <th>Mật khẩu</th>
                    <th>Số điện thoại</th>
                    <th>Vai trò</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_GET["id_user"]))
                    {
                        $id_user = $_GET['id_user'];
                        $sql = "DELETE FROM users WHERE id_user=$id_user";
                        $result = execute($sql);
                        echo '<script>alert("Đã xóa thành công!")</script>';
                        echo "<script>window.location.href='index.php?page=feedback.php'</script>";
                    }
                    // Lấy danh sách danh mục sản phẩm từ database
                    $sql = 'SELECT users.id_user, users.fullname, users.email, users.password, users.phone_number, users.role FROM users';
                    $users = executeResult($sql);
                    $index = 1;
                    foreach($users as $item) : 
                ?>
            
                <tr>
                    <td><?php echo $index++; ?></td>
                    <td><?php echo $item['id_user']; ?></td>
                    <td><?php echo $item['fullname']; ?></td>
                    <td><?php echo $item['email']; ?></td>
                    <td><?php echo $item['password']; ?></td>
                    <td><?php echo $item['phone_number']; ?></td>
                    <td>
                        <?php 
                            if ($item['role']==1) {
                                echo 'Admin';
                            }else{
                                echo 'user'; 
                            }
                        ?>
                
                    </td>
                    <td>
                        <a href="index.php?page=users.php&id_user=<?php echo $item['id_user'];?>" class="btn btn-danger">Xóa</a>
                    </td>
                </tr>
                        
            </tbody>
            <?php endforeach; ?>
        </table>
    </div>
</div>



