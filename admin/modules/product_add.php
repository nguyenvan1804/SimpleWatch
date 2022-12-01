<?php
    include "db/database.php";

    if ( $_SERVER['REQUEST_METHOD']==='POST') {
        $id_category = $_POST['id_category'];
        $title = $_POST['product_name'];
        $price = $_POST['price'];
        $discount = $_POST['discount'];
        $descript = $_POST['descript'];
        $created_at = $updated_at = date('Y-m-d');
        // Điều kiện kiểm tra định dạng ảnh, nếu không phải ảnh không cho upload
        if ($_FILES['images']['type'] == "image/jpeg" || $_FILES['images']['type'] == "image/png" || $_FILES['images']['type'] == "image/gif") {
            $tmp_name = $_FILES['images']['tmp_name'];
            $images = $_FILES['images']['name'];

        }
        if(isset($_FILES['multiImg'])){
            $files = $_FILES['multiImg'];
            $file_names = $files['name'];

            foreach ($file_names as $key => $value) {
                move_uploaded_file($files['tmp_name'][$key], 'image/'.$value);
            }
        }
        $conn = mysqli_connect('localhost:3306', 'root', '', 'shop');
        $sql = "INSERT INTO product (category_id, title, price, discount, images, descript, created_at, updated_at) VALUES ('$id_category','$title','$price','$discount','$images','$descript','$created_at','$updated_at')";
        $productAdd = mysqli_query($conn,$sql);
        $id_pro = mysqli_insert_id( $conn);
        
        foreach ($file_names  as $key => $value) {
            $sql = "INSERT INTO `galery`(`product_id`, `images`) VALUES ('$id_pro','$value')";
            mysqli_query($conn,$sql);
        }
        echo '<script>alert("Thêm sản phẩm thành công!")</script>';
        echo "<script>window.location.href='index.php?page=product_list.php'</script>";
    }
?>


<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Trang quản trị Admin</h3>
    </div>
    <!--content-->
    <div class="main-content">
        <h2>Thêm sản phẩm</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Chọn loại sản phẩm</label>
                <select name="id_category" class="form-select" aria-label=".form-select-sm">
                    <?php
                        // Lấy danh sách danh mục sản phẩm từ database
                        $sql = 'select * from category';
                        $categoryList = executeResult($sql);
                        foreach($categoryList as $item) : 
                    ?>
                
                    <option value="<?php echo $item['id_category']; ?>"><?php echo $item['name_category']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Nhập Tên sản phẩm</label>
                <input name ="product_name" type="text" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Giá sản phẩm</label>
                <input name ="price" type="text" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Giá khuyến mãi</label>
                <input name ="discount" type="text" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Ảnh sản phẩm</label>
                <input name ="images" type="file" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Ảnh mô tả</label>
                <input name ="multiImg[]" type="file" class="form-control" multiple="multiple">
            </div>
            <div class="mb-3">
                <label class="form-label">Mô tả sản phẩm</label>
                <textarea name="descript" class="form-control" id="" cols="30" rows="10"></textarea>
            </div>
            <button name ="add" type="submit" class="btn btn-success">Thêm</button>
        </form>
    </div>
</div>

