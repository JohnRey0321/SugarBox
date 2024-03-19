<?php
    include 'db.php';

    if (isset($_POST['submit-btn'])) {
        $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $name = mysqli_real_escape_string($conn, $filter_name);

        $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $email = mysqli_real_escape_string($conn, $filter_email);

        $filter_number = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
        $number = mysqli_real_escape_string($conn, $filter_number);

        $filter_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $password = mysqli_real_escape_string($conn, $filter_password);

        $filter_cpassword = filter_var($_POST['cpassword'], FILTER_SANITIZE_STRING);
        $cpassword = mysqli_real_escape_string($conn, $filter_cpassword);

        $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE email='$email'") or die ('query failed');

        if(mysqli_num_rows($select_user) > 0) {
            $message[] = 'User already exists.';
        } else {
            if ($password != $cpassword) {
                $message[] = 'Passwords do not match.';
            } else {
                // Insert user data into the database
                mysqli_query($conn, "INSERT INTO `users` (`name`, `email`, `number`, `password`, `image`) VALUES ('$name', '$email', '$number', '$password', '$image_path')") or die ('query failed');
                $message[] = 'Registered successfully';
                header('location: login.php');
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
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!--== CSS ==-->
    <link rel="stylesheet" href="css/style.css">
    <title>Register page</title>
</head>
<body>


    <section class="form-container">
        <div class="box">
    <?php
        if (isset($message)) {
            foreach($message as $msg) {
                echo '
                        <div class="message">
                            <span>'.$msg.'</span>
                        <i class=" bx bx-x-circle" onclick="this.parentElement.remove()"></i>
                        </div>      
                ';
            }
        }

    ?>


        <form method="post" enctype="multipart/form-data">
            <h1>Register now</h1>
            <input type="text" name="name" placeholder="Enter your name" required>
            <input type="number" name="number" placeholder="Enter your mobile number" required>
            <input type="email" name="email" placeholder="example@email.com" required>
            <input type="password" name="password" placeholder="Enter your password" required>
            <input type="password" name="cpassword" placeholder="Confirm your password" required>
            <input type="submit" name="submit-btn" value="register now" class="btn">
            <p>Already have an account? <a href="login.php">login now</a></p>
        </form>
        </div>
    </section>

    
</body>
</html>
