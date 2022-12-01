<?php 
    include('nav.php');
    if (isset($_POST['submit'])) {
        if (isset($_SESSION['fullname'])) {
            $user_id = $_SESSION['id_user'];
            $fullname = $_POST['fullname'];
            $message = $_POST['message'];
            $email = $_POST['email'];
            $phone_number = $_POST['phone_number'];

            $sql = "INSERT INTO `feedback`(`user_id`, `fullname`, `email`, `phone_number`, `message`) VALUES ('$user_id', '$fullname','$email','$phone_number','$message')";

            $result = execute($sql);
            echo '<script>alert("Gửi phản hồi thành công !")</script>';        
            echo "<script>window.location.href='contact.php'</script>";
        }else{
            $fullname = $_POST['fullname'];
            $message = $_POST['message'];
            $email = $_POST['email'];
            $phone_number = $_POST['phone_number'];

            $sql = "INSERT INTO `feedback`(`fullname`, `email`, `phone_number`, `message`) VALUES ('$fullname','$email','$phone_number','$message')";

            $result = execute($sql);
            echo '<script>alert("Gửi phản hồi thành công !")</script>';     
            echo "<script>window.location.href='contact.php'</script>";

        }
    }
?>

 <!-- contact section starts -->
 <section class="contact" id="lh">

    <div class="container">
        <h2 class="">Liên hệ </h2>
        <hr style="width:100%;">
    </div>

    <div class="row">
        <form action="" method="POST">
            <input name="fullname" type="text" placeholder="Họ tên" class="box">
            <input name="email" type="email" placeholder="Email" class="box">
            <input name="phone_number" type="number" placeholder="Số điện thoại" class="box">
            <textarea name="message" class="box" placeholder="Lời nhắn" id="" cols="30" rows="10"></textarea>
            <button name="submit" class="submit">Gửi lời nhắn</button>
        </form>

        <div class="image">
            <div class="info">
                <a class="nav-link"><i class="fas fa-map-marker"></i> Đà Nẵng</a>
                <a class="nav-link"><i class="fas fa-phone"></i> 0123456789</a>
                <a class="nav-link"><i class="fas fa-envelope "></i> nwatch@gmail.com</a> 
            </div>
            
            <img src="image/contact1.webp" alt="">

        </div>
    </div>
</section>
<?php include('footer.php');?>