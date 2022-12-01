<?php
    include "db/database.php";
?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Trang quản trị Admin</h3>
    </div>
    <!--content-->
    <div class="main-content">
        <h2>Danh sách phản hồi</h2>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th  width="20px"> ID_User</th>
                    <th>Họ Tên</th>
                    <th>Email</th>
                    <th>SĐT</th>
                    <th>Phản hồi</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                     if(isset($_GET["id_feedback"]))
                     {
                         $id_feedback = $_GET['id_feedback'];
                         $sql = "DELETE FROM feedback WHERE id_feedback=$id_feedback";
                         $result = execute($sql);
                         echo '<script>alert("Đã xóa thành công!")</script>';
                         echo "<script>window.location.href='index.php?page=feedback.php'</script>";
                     }
                    // Lấy danh sách danh mục sản phẩm từ database
                    $sql = 'SELECT feedback.id_feedback, feedback.fullname, feedback.email, feedback.phone_number, feedback.message, 
                    users.id_user FROM feedback LEFT OUTER JOIN users ON feedback.user_id = users.id_user';
                    $feedback = executeResult($sql);
                    $index = 1;
                    foreach($feedback as $item) : 
                ?>
            
                <tr>
                    <td><?php echo $index++; ?></td>
                    <td><?php echo $item['id_user']; ?></td>
                    <td><?php echo $item['fullname']; ?></td>
                    <td><?php echo $item['email']; ?></td>
                    <td><?php echo $item['phone_number']; ?></td>
                    <td><?php echo $item['message']; ?></td>
                    <td>
                        <a href="index.php?page=feedback.php&id_feedback=<?php echo $item['id_feedback'];?>" class="btn btn-danger">Xóa</a>
                    </td>
                </tr>
                        
            </tbody>
            <?php endforeach; ?>
        </table>
    </div>
</div>



