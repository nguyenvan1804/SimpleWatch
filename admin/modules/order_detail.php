<?php
    include "db/database.php";    
    if (isset($_GET['id_orders'])) {
        $id_orders = $_GET['id_orders'];
        $sql = "SELECT * FROM orders WHERE id_orders = $id_orders" ;
        $orderList = executeResult($sql);

        $query = "SELECT order_details.num, order_details.total_money, product.title, product.images, product.price
        FROM order_details JOIN product ON order_details.product_id = product.id_product WHERE order_details.order_id=$id_orders";
        $orderDetail = executeResult($query);
    }

    if(isset($_POST['status'])){
        $status = $_POST['status'];
        $sql = "UPDATE orders SET status = $status WHERE id_orders=$id_orders";
        execute($sql);
        echo "<script>window.location.href='index.php?page=order.php'</script>";
        // header('location: index.php?page=order.php');
    }

?>

<div class="card card-primary">
    <h2 style="padding-top: 15px;">Chi tiết đơn hàng</h2>
    <!--content-->
    <div class="main-content">
        
        <div class="row">
            <div class="card-header" style="background-color: rgb(196, 222, 245); color: rgb(34, 130, 171);">
                <h3 class="card-title">Thông tin khách hàng</h3>
            </div>
            <div class="panel panel-infor">
                <?php 
                    //  $index = 1;
                     foreach($orderList as $item) : 
                ?>
                <div class="panel-body text-left">
                    <table style="border-spacing: 15px;">
                        <tr>
                            <td><b>Tên khách hàng: </b></td>
                            <td><?php echo $item['fullname'];?></td>
                        </tr>
                        <tr>
                            <td><b>Số điện thoại: </b></td>
                            <td><?php echo $item['phone_number'];?></td>
                        </tr>
                            <td><b>Địa chỉ nhận hàng: </b></td>
                            <td><?php echo $item['address'];?></td>
                        </tr>
                        <tr>
                            <td><b>Ngày đặt hàng: </b></td>
                            <td><?php echo $item['order_date'];?></td>
                        </tr>
                        <tr>
                            <td><b>Trạng thái đơn hàng: </b></td>
                            <td>
                                <?php if($item['status'] == 0) {?> Chưa xử lý 
                                <?php }elseif($item['status'] == 1) {?> Đã xử lý
                                <?php }elseif($item['status'] == 2) {?> Đang giao hàng
                                <?php }elseif($item['status'] == 3) {?> Đã giao hàng
                                <?php }else{?> Hủy đơn <?php }?>
                            </td>
                        </tr>
                    </table>               
                </div>
                <!-- -->
            </div>
        </div>
        <div class="row">
            <div class="card-header" style="background-color: rgb(196, 222, 245); color: rgb(34, 130, 171);">
                <h3 class="card-title">Thông tin đơn hàng</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $index = 1;
                            foreach($orderDetail as $key) : 
                        ?>
                    
                        <tr>
                            <td><?php echo $index++; ?></td>
                            <td><img style="width:100px; height:100px;" src="../images/<?php echo $key['images'];?>"/></td>
                            <td><?php echo $key['title']; ?></td>
                            <td><?php echo $key['num']; ?></td>
                            <td><?php echo number_format($key['price'], 0, ",", ".");?></td>
                            <td><?php echo number_format($key['total_money'], 0, ",", ".");?></td>
                        </tr>  
                        <?php endforeach; ?> 
                        <tr>
                            <td></td>
                            <td>Tổng tiền</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><?php echo number_format($item['total_money'], 0, ",", ".");?></td>
                        </tr>
                    </tbody>
                </table>
                <?php endforeach ;?>
            </div>
            <div class="row">
                <div class="card-body"> 
                    <form action="" method="post" class="form-inline">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Trạng thái đơn hàng</label>
                        </div>
                        <select name="status" class="custom-select">
                            <option value="0">Chưa xử lý</option>
                            <option value="1">Đã xử lý</option>
                            <option value="2">Đang giao hàng</option>
                            <option value="3">Đã giao hàng</option>
                            <option value="4">Hủy đơn</option>
                        </select>
                        <button type="submit" class="btn btn-primary" style="margin-left: 20px;">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

