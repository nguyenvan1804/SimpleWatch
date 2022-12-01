<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Cart</title>
    </head>
    <body>
        <?php 
            include('nav.php');   
            if(!isset($_SESSION['cart'])){
                $_SESSION['cart']=array();
            } 
            $error = false;
            if(isset($_GET['action'])){
                function update_cart(){
                    foreach ($_POST['num'] as $id => $num) {
                        $_SESSION['cart'][$id] = $num;
                    }
                }
                switch ($_GET['action']) {
                    case 'add':
                        update_cart();
                        header('location: cart.php');
                        // var_dump($_SESSION['cart']); exit();
                        break;

                    case 'delete':
                        if(isset($_GET['id_product'])){
                            unset($_SESSION['cart'][$_GET['id_product']]);
                        }
                        header('location: cart.php');
                        
                        break;

                    case 'submit':
                        if(isset($_POST['update'])){//cập nhật số lượng sản phẩm
                            update_cart();
                            header('location: cart.php');
                        }elseif (isset($_POST['order'])) {//đặt hàng 
                            if (empty($_POST['fullname'])||empty($_POST['phone_number'])||empty($_POST['address'])) {
                               echo '<script>alert("Bạn chưa nhập đầy đủ thông tin!!")</script>';
                               $error = true;
                            }elseif (empty($_POST['num'])) {
                                echo '<script>alert("Chưa có sản phẩm nào trong giỏ hàng!!")</script>';
                                $error = true;
                            }
                            if ($error ==false && !empty($_POST['num']) && isset($_SESSION['id_user'])) {//xử lý giỏ hàng vào database
                                $sql = "SELECT * FROM product WHERE `id_product` IN (".implode(",",array_keys($_POST['num'])).")";
                                $listcart = executeResult($sql);
                                $total = 0;
                                foreach ($listcart as $key) {
                                    $total += $key['price']*$_POST['num'][$key['id_product']];
                                }
                                $id_user = $_SESSION['id_user'];
                                $query = "INSERT INTO `orders` (`user_id`, `fullname`, `phone_number`, `address`, `order_date`, `total_money`) 
                                VALUES ('".$id_user."', '".$_POST['fullname']."', '".$_POST['phone_number']."', '".$_POST['address']."', '".date("Y-m-d")."', '".$total."');";
                                $insertOder = mysqli_query($conn,$query);
                                
                                $order_id = $conn->insert_id;
                                $listOderDetail = "";
                                $count=0;  //var_dump($count); exit;
                                // (NULL, '13', '39', '123456', '2', NULL), 
                                foreach ($listcart as $key) {
                                    $count++;
                                    $listOderDetail .= "('".$order_id."', '".$key['id_product']."', '".$key['price']."','".$_POST['num'][$key['id_product']]."', '".$key['price']*$_POST['num'][$key['id_product']]."')";
                                    if ($count != count($listcart)) {
                                        $listOderDetail .= ",";
                                    }
                                }
                                // var_dump($insertOderDetail); exit;
                                $query2 = "INSERT INTO `order_details`(`order_id`, `product_id`, `price`, `num`, `total_money`) VALUES ".$listOderDetail.";";
                                $insertOderDetail = execute($query2);
                                header('location: notify.php');
                                unset($_SESSION['cart']);
                            } elseif(!isset($_SESSION['id_user'])){
                               header('location: login.php');
                            }
                        }
                        break;
                    
                    default:
                        # code...
                        break;
                }
            }  
            if (!empty($_SESSION['cart'])) {
                // var_dump(implode(",",array_keys($_SESSION['cart']))); exit;
                $sql = "SELECT * FROM product WHERE `id_product` IN (".implode(",",array_keys($_SESSION['cart'])).")";
                $list = executeResult($sql);
            }
        ?>

        <section id="blog-home" class="pt-5 mt-5  container">
            <h2 class="font-weight-bold pt-4">Shopping Cart</h2>
            <hr>
        </section>

        <section id="cart-container" class="container my-4">
            <form action="cart.php?action=submit" method="POST">
                <table width="100%">
                    <thead>
                        <tr>
                            <td>Remove</td>
                            <td>Image</td>
                            <td>Product</td>
                            <td>Price</td>
                            <td>Quatity</td>
                            <td>Total</td>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            if(!empty($list)){
                                $total =0;
                            
                                foreach ($list as $key) {                            
                            ?>
                            <tr>
                                <td><a href="cart.php?action=delete&id_product=<?php echo $key['id_product']?>"><i class="fas fa-trash-alt"></i></a></td>
                                <td><img src="images/<?php echo $key['images'];?>" alt=""></td>
                                <td><h5><?php echo $key['title'];?></h5></td>
                                <td><h5><?php echo number_format($key['price'], 0, ",", ".");?>đ</h5></td>
                                <td><input class="w-25 pl-1" value="<?php echo $_SESSION['cart'][$key['id_product']]?>" type="number" name="num[<?php echo $key['id_product'];?>]" min="1"></td>
                                <td><h5><?php echo number_format($key['price']*$_SESSION['cart'][$key['id_product']], 0, ",", ".")?>đ</h5></td>
                            </tr>
                                <?php 
                                    $total += $key['price'] * $_SESSION['cart'][$key['id_product']];
                                    }  
                                ?>
                            <tr style="background-color: #fac8b3;">
                                <td>Tổng tiền</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><h5><?php echo number_format($total, 0, ",", ".");?></h5></td>
                            </tr>
                            <?php } ?>
                    </tbody>
                </table>
                <div>
                    <button class="ml-auto" style="margin-top:30px;" name="update">Cập nhật</button>
                </div>
                <hr style="width:100%;">
                <section id="cart-bottom" class="container">
                    <div class="row">
                        <div class="total">
                            <div>
                                <h5>Thông tin người nhận</h5>
                                <label class="col-3 col-form-label">Tên khách hàng</label>
                                <input type="text" class="col-8" name="fullname">
                                <label class="col-3 col-form-label">Số điện thoại</label>
                                <input type="text" class="col-8" name="phone_number">
                                <label class="col-3 col-form-label">Địa chỉ</label>
                                <input type="text" class="col-8" name="address">
                                <button class="ml-auto" style="margin-top:30px;" name="order">Đặt hàng</button>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
        </section>
        <?php include('footer.php');?>
    </body>
</html>