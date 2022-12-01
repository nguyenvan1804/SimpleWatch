<?php
    include "db/database.php";
    if(isset($_GET['id_category'])){
        $id_category = $_GET['id_category'];
        $sql = "SELECT * FROM category WHERE id_category = '$id_category';";
        $category_edit = executeSingleResult($sql);
        $nameCategory = $category_edit['name_category'];
        $idCategory = $category_edit['id_category'];
    }
    if ( isset($_POST["add"])) {
        $name_category= $_POST['name_category'];

        if(empty($_POST['id_category'])){
            $sql = "INSERT INTO category (name_category) VALUES ('$name_category')";
            $categoryAdd = execute($sql);
            echo '<script>alert("Thêm danh mục thành công!")</script>';
        }else{
            $sql = "UPDATE category SET name_category ='$name_category' WHERE id_category=$id_category;";
            $category_edit = execute($sql);
            echo '<script>alert("Cập nhập thành công!")</script>';
        }
        echo "<script>window.location.href='index.php?page=category_list.php'</script>";
    }
?>
<div class="card card-primary" style="padding: 0px 30px 50px 30px ;">
    <div class="card-header">
        <h3 class="card-title">Trang quản trị Admin</h3>
    </div>
    <!--content-->
    <div class="main-content" style="padding-top:20px;">
        <h2><?php echo isset($_GET['id_category'])?"Cập nhật":"Thêm"?> danh mục</h2>
        <form action="" method="post"> 
            <div class="mb-3">
                <input name ="id_category" type="hidden" class="form-control" value="<?php echo !empty($idCategory)?"$idCategory":""?>">
                <label class="form-label">Nhập Tên danh mục sản phẩm</label>
                <input name ="name_category" type="text" class="form-control" value="<?php echo !empty($nameCategory)?"$nameCategory":""?>" required>
            </div>
            <button name ="add" type="submit" class="btn btn-success"><?php echo empty($_GET['id_category'])?"Thêm":"Cập nhật"?></button>
        </form>
    </div>
</div>