<?php 

    include '../db.php';
    session_start();
    $admin_id = $_SESSION['admin_name'];

    if (!isset($admin_id)){
        header('location:../login.php');
    }
    if (isset($_POST['logout'])){
        session_destroy();
        header('location:../login.php');
    }

    //DELETE PRODUCTS FROM DATABASE
    if (isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        
        mysqli_query($conn, "DELETE FROM `message` WHERE id = $delete_id") or die ('query failed');

        header('location:admin_message.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--== Box Icon Link ==-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <!----========== BOOTSTRAP CSS =============---->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">


    <!--== CSS ==-->
    <link rel="stylesheet" href="../css/style.css">

    <title>admin pannel</title>
</head>
<body>
    
<?php include 'admin_header.php'; ?>
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

    <div class="line4"></div>
        <div class="message-container">
        <h1 class="title">leave a message</h1>
        <form method="post">
            <div class="input-field">
                <label>your name</label><br>
                <input type="text" name="name" required>
            </div>
            <div class="input-field">
                <label>your email</label><br>
                <input type="text" name="email" required>
            </div>
            <div class="input-field">
                <label>Number</label><br>
                <input type="number" name="number" required>
            </div>
            <div class="input-field">
                <label>your message</label><br>
                <textarea name="message" required></textarea>
                <button type="submit" name="submit-btn" class="message-btn">send message</button>
            </div>
        </form>
    </div>

       
                
    <div class="line"></div>
<script type="text/javascript" src="../js/script.js"></script>
</body>
</html>