<?php
    include 'db.php';

    session_start();
    if (isset($_POST['submit-btn'])){
       
        $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $email = mysqli_real_escape_string($conn, $filter_email);

        $filter_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $password = mysqli_real_escape_string($conn, $filter_password);

        $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE email='$email' && password='$password'") or die ('query failed');

        if(mysqli_num_rows($select_user) > 0){
            $row = mysqli_fetch_assoc($select_user);
            if ($row['user_type'] == 'admin'){
                $_SESSION['admin_name'] = $row['name'];
                $_SESSION['admin_password'] = $row['password'];
                $_SESSION['admin_email'] = $row['email'];
                $_SESSION['admin_id'] = $row['id'];
                header('location: admin/admin_pannel.php');
            }else if($row['user_type'] == 'user'){
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_password'] = $row['password'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['user_id'] = $row['id'];
                header('location:user/index.php');
            }else{
                $message[] = 'incorrect email or password';
            }
        }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--== Box Icon Link ==-->
    <link href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css' rel='stylesheet'>

    <!--== CSS ==-->
    <link rel="stylesheet" href="css/register.css">
    <title>Login</title>
</head>
<body>
        <!-- BACKGROUND IMAGE-->
        <style>
            body{
            background-image: url(img/bg4.jpeg);
            background-size: cover;
            background-repeat: no-repeat;
            }
        </style>

<!-- LOGIN FORM -->
      <div class="hero">
        <div class="form_box">
          <div class="button_box">
            <div id="btn"></div>
              <button type="button" class="toogle-btn" onclick="login()">Log In</button>
              <button type="button" class="toogle-btn" onclick="register()">Register</button>
           </div>

      <?php
        if (isset($message)) {
            foreach($message as $message) {
                echo '
                        <div class="message">
                            <span>'.$message.'</span>
                        <i class=" bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                        </div>      
                ';
            }
        }

    ?>  

        <form method="post" id="login" class="input-group">
            <h1 class="text">login now</h1>
                <input type="email" name="email" placeholder="enter your email" class="input-field" required>
                <input type="password" name="password" placeholder="enter your password" class="input-field" required>
            <input type="submit" name="submit-btn" value="login now" class="submit-btn">
            <p>do not have an account? <a href="register.php">register now</a></p>
        </form>
  <!-- END OF LOGIN FORM -->


       <!--==REGISTRATION FORM==-->
       <form method="post" id="register" class="input-group">
            <h1 class="text">Register now</h1>
            <input type="text" name="name" placeholder="enter your name" class="input-field" required>
            <input type="email" name="email" placeholder="enter your email" class="input-field" required>
            <input type="password" name="password" placeholder="enter your password" class="input-field" required>
            <input type="password" name="cpassword" placeholder="confirm your password" class="input-field" required>
            <input type="submit" name="submit-btn" value="register now" class="submit-btn">
            <p>already have an account? <a href="login.php">login now</a></p>
        </form>
            </div>
         </div>
    <!--==END REGISTRATION FORM==-->

    <!--========== CUSTOM SCRIPT ============-->
    <script>
      var x = document.getElementById("login");
      var y = document.getElementById("register");
      var z = document.getElementById("btn");

      function register(){
        x.style.left = "-400px";
        y.style.left = "50px";
        z.style.left = "110px";
      }
      function login(){
        x.style.left = "50px";
        y.style.left = "450px";
        z.style.left = "0px";
      }

    </script>

    
</body>
</html>