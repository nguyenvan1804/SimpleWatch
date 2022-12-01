<!DOCTYPE html>
<html lang="en">
    <body>
        <?php include('nav.php');?>
        <?php
            $sql = "SELECT * FROM category";
            $category = executeResult($sql);
            $query = "SELECT * FROM product";
            $product = executeResult($query);
        ?>
        <section id="featured" class="my-5 py-4">
            <div class="container mt-5">
                <h2 class="font-weight-bold">Our Featured</h2>
                <hr>                
                <p>Here you can check out our new products with fair price on rymo.</p>
            </div>
            
            <div class="row mx-auto container-fluid">
                <?php foreach($product as $key => $value): 
                ?>
                <div onclick="window.location.href='product_detail.php?id_product=<?php echo $value['id_product']?>'" class="product text-center col-lg-3 col-md-4 col-12">
                    <img class="img-fluid mb-3" src="images/<?php echo $value['images']?>" alt="">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5 class="p-name"><?php echo $value['title']?></h5>
                    <h4 class="p-price"><?php echo number_format($value['discount'])?><sup>đ</sup></h4>
                    <h5 class="p-price"><del><?php echo number_format($value['price'])?><sup>đ</sup></del></h5>
                    <button class="buy-btn">Show More</button>
                </div>
                <?php endforeach?>
            </div>

            <?php 
                $sql1 = "SELECT * FROM category";
                $ListCate= executeResult($sql1);
                foreach ($ListCate as $key ) {
                $id = $key['id_category'];
            ?>
            
            <section id="<?php echo $key['id_category'];?>" class="">
                <div class="container text-center mt-5">
                    <h2 class="form-title"><?php echo $key['name_category'];?></h2>
                    <hr class="mx-auto">
                    <p>Here you can check out our new products with fair price on rymo.</p>
                </div>
                <div class="row mx-auto container-fluid">
                    <?php 
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

            <nav aria-label="...">
                <ul class="pagination mt-5">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item" aria-current="page">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>

        </section>

    <?php include('footer.php');?>
    </body>
</html>