<?php
    // session_start();
    include "db/database.php";
    if(!isset($_GET['id_product']) || $_GET['id_product']==NULL){
        echo '<script>alert("Giá trị ID không tồn tại. Vui lòng kiểm tra lại.!")</script>';
    }else{
        $id_product = $_GET['id_product'];
        $conn = mysqli_connect('localhost:3306', 'root', '', 'shop');
        $sql = "SELECT * FROM product WHERE id_product = $id_product";
        $product_edit = executeSingleResult($sql);
        $query = "SELECT * FROM galery WHERE product_id = $id_product";
        $img_pro = mysqli_query($conn,$query);
    }
?>


<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Trang quản trị Admin</h3>
    </div>
    <!--content-->
    <div class="main-content">
        <h2>Cập nhật sản phẩm</h2>
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
                
                    <option value="<?php echo $item['id_category']; ?>" <?php echo(($item['id_category']==$product_edit['category_id'])?'selected':'')?>><?php echo $item['name_category']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Nhập Tên sản phẩm</label>
                <input value="<?php echo $product_edit['title'];?>" name ="name_product" type="text" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Giá sản phẩm</label>
                <input value="<?php echo $product_edit['price'];?>" name ="price" type="text" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Giá khuyến mãi</label>
                <input value="<?php echo $product_edit['discount'];?>" name ="discount" type="text" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Ảnh sản phẩm</label>
                <input name ="images" type="file" class="form-control">
                <img src="../image/<?php echo $product_edit['images'];?>" alt="" style="max-width: 300px;">
            </div>
            <div class="mb-3">
                <label class="form-label">Ảnh mô tả</label>
                <input name ="multiImg[]" type="file" class="form-control" multiple="multiple">
                <div class="row">
                    <?php foreach ($img_pro as $item) :?>
                    <div class="col-md-3">
                        <a href="">
                            <img src="../image/<?php echo $item['images'];?>" alt="" style="max-height:200px;">
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Mô tả sản phẩm</label>
                <textarea value="<?php echo $product_edit['descript'];?>"name="descript" class="form-control" id="" cols="30" rows="10"></textarea>
            </div>

            <button name ="save" type="submit" class="btn btn-success">Cập nhật</button>
        </form>
    </div>
</div>
               

<?php
    if (isset($_POST['save'])) {
        // Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
        $id_category = $_POST['id_category'];
        $title = $_POST['name_product'];
        $price = $_POST['price'];
        $discount = $_POST['discount'];
        $descript = $_POST['descript'];
        $updated_at = date('Y-m-d');

        if (isset($_FILES['images'])) {
            $tmp_name = $_FILES['images']['tmp_name'];
            $images = $_FILES['images']['name'];
            if (empty($images)) {
                $images = $product_edit['images'];
            }else{
                if ($_FILES['images']['type'] == "image/jpeg" || $_FILES['images']['type'] == "image/png" || $_FILES['images']['type'] == "image/gif") {
                    foreach ($file_names as $key => $value) {
                        move_uploaded_file($files['tmp_name'][$key], 'image/'.$images);
                    }
                }else{
                    echo"Không đúng định dạng";
                    $images="";
                }
            }
        }
        
        if (isset($_FILES['multiImg'])) {
            $files = $_FILES['multiImg'];
            $file_names = $files['name'];
            if (!empty($file_names[0])) {
                $id_product = $_GET['id_product'];
                $sql = "DELETE FROM galery WHERE product_id = $id_product;";
                $result = execute($sql);
              
                foreach ($file_names  as $key => $value) {
                    $sql = "INSERT INTO `galery`(`product_id`, `images`) VALUES ('$id_product','$value')";
                    mysqli_query($conn,$sql);
                }
            }
        }
        $query = "UPDATE product SET category_id ='$id_category', title = '$title', price = '$price', 
        discount ='$discount', images = '$images' , descript ='$descript',
        updated_at = '$updated_at' WHERE id_product = $id_product;";
        $productEdit = execute($query);
        echo '<script>alert("Cập nhập thành công!")</script>';
        echo "<script>window.location.href='index.php?page=product_list.php'</script>";
    }
?>
