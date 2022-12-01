<!DOCTYPE html>
<html lang="en">
    <body>
        <?php include('nav.php');?>

        <section id="home">
            <div class="container">
                <div class="content">
                    <h5>NEW ARRAIVALS</h5>
                    <h1><span>Best Price</span> This Year</h1>
                    <p>Shoomatic offers your very comfortable time<br>on walking and exercises.</p>
                </div>
                <button onclick="window.location.href='shop.php'">Shop now</button>
            </div>
        </section>

        <section id="brand" class="container">
            <div class="row m-0 py-5">
                <img class="img-fluid col-lg-2 col-md-4 col-6" src="images/Brand-1.png" alt="">
                <img class="img-fluid col-lg-2 col-md-4 col-6" src="images/Brand-2.png" alt="">
                <img class="img-fluid col-lg-2 col-md-4 col-6" src="images/Brand-3.png" alt="">
                <img class="img-fluid col-lg-2 col-md-4 col-6" src="images/Brand-4.png" alt="">
                <img class="img-fluid col-lg-2 col-md-4 col-6" src="images/Brand-5.png" alt="">
                <img class="img-fluid col-lg-2 col-md-4 col-6" src="images/Brand-6.png" alt="">
            </div>
        </section>

        <section id="new" class="w-100">
            <div class="row p-0 m-0">
                <div class="one col-lg-4 col-md-12 col-12 p-0">
                    <img class="img-fluid" src="images/New1.jpg" alt="">
                    <div class="details">
                        <h2>Soft-Luxurious Women's Watch</h2>
                        <button onclick="window.location.href='shop.php'" class="text-uppercase">Shop now</button>
                    </div>                    
                </div>
                <div class="one col-lg-4 col-md-12 col-12 p-0">
                    <img class="img-fluid" src="images/New2.jpg" alt="">
                    <div class="details">
                        <h2>Modern & Smart Model</h2>
                        <button onclick="window.location.href='shop.php'" class="text-uppercase">Shop now</button>
                    </div>                    
                </div>
                <div class="one col-lg-4 col-md-12 col-12 p-0">
                    <img class="img-fluid" src="images/New3.jpg" alt="">
                    <div class="details">
                        <h2>Noble Men's Watch</h2>
                        <button onclick="window.location.href='shop.php'" class="text-uppercase">Shop now</button>
                    </div>                    
                </div>
            </div>
        </section>

            <?php 
                $sql1 = "SELECT * FROM category";
                $ListCate= executeResult($sql1);
                foreach ($ListCate as $key ) {
                $id = $key['id_category'];
            ?>
            
            <section id="<?php echo $key['id_category'];?>" class="my-5 pb-5">
                <div class="container text-center mt-5 py-5">
                    <h2 class="form-title"><?php echo $key['name_category'];?></h2>
                    <hr class="mx-auto">
                    <p>Here you can check out our new products with fair price on rymo.</p>
                </div>
                <div class="row mx-auto container-fluid">
                    <?php 
                        $query = "SELECT * FROM product";
                        $product = executeResult($query);
                        $sql2 = "SELECT * FROM product WHERE category_id =$id";
                        $ListProduct= executeResult($sql2);
                        foreach ($ListProduct as $item ) {        
                    ?>
                    
                    <div onclick="window.location.href='product_detail.php?id_product=<?php echo $item['id_product']?>'" class="product text-center col-lg-3 col-md-4 col-12">
                        <img class="img-fluid mb-33" src="images/<?php echo $item['images']?>" alt="">
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <h5 class="p-name"><?php echo $item['title']?></h5>
                        <h4 class="p-price"><?php echo number_format($item['discount'])?><sup>đ</sup></h4>
                        <h5 class="p-price"><del><?php echo number_format($item['price'])?><sup>đ</sup></del></h5>
                        <button class="buy-btn">Show More</button>
                    </div>  
                    <?php }?>    
                </div>
            </section>
            
            <?php }?>

        <?php include('footer.php');?>
    </body>
</html>