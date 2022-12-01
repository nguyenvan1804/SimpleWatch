<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://colorlib.com/etc/regform/colorlib-regform-7/fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="css/login.css">
    <!-- <link rel="stylesheet" href="template/fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="template/css/style.css"> -->
</head>
<body>
    <?php 
        include('nav.php');

        if (isset($_POST['signup'])) {
            $fullname = $_POST['fullname'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $phone_number = $_POST['phone_number'];

            $password = md5($password);  // Mã khóa mật khẩu
            $sql = "INSERT INTO `users`(`fullname`, `email`, `password`,`phone_number`) VALUES ('$fullname','$email','$password','$phone_number')";

            $result = execute($sql);
            echo '<script>alert("Đăng ký thành công !")</script>';        
            echo "<script>window.location.href='login.php'</script>";
        }
    ?>
    <div class="main">
        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="fullname" id="name" placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="pass" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-phone"></i></label>
                                <input type="text" name="phone_number" placeholder="Your phone number"/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                                <a href="login.php" class="signup-image-link">I am already member</a>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <!-- JS -->
    <script src="https://colorlib.com/etc/regform/colorlib-regform-7/vendor/jquery/jquery.min.js"></script>
    <!-- <script src="template/vendor/jquery.min.js"></script> -->
</body>
</html>