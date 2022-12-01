<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <!-- <link rel="stylesheet" href="template/fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="template/css/style.css"> -->
    <link rel="stylesheet" href="https://colorlib.com/etc/regform/colorlib-regform-7/fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <?php include('nav.php');?>
    <div class="main">

        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Sign in</h2>
                        <form method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="fullname" id="your_name" placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="your_pass" placeholder="Password"/>
                            </div>

                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                                <a href="register.php" class="signup-image-link">Create an account</a>
                            </div>
                        </form>
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
<?php 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $fullname = $_POST['fullname'];
        $password = $_POST['password'];
        $password = md5($password);
        $sql ="SELECT * FROM users WHERE fullname='$fullname' AND password='$password'";
        $user = executeSingleResult($sql);

        if ($user == 0){
            echo '<script>alert("Sai tên đăng nhập hoặc mật khẩu! !")</script>';
            echo "<script>window.location.href='login.php'</script>";
        }
        else
        {
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['password'] = $user['password'];
            $_SESSION['id_user'] = $user['id_user'];
            if ($user['role'] == 1){
                $_SESSION['role'] = 'admin';
                echo "<script>window.location.href='admin/index.php'</script>";
            }
            else{
                $_SESSION['role'] = 'user';
                echo "<script>window.location.href='index.php'</script>";
            }
        }
    }
?>