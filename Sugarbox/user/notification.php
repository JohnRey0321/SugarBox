<?php 

    include '../db.php';
    session_start();
    $user_id = $_SESSION['user_id'];

    if (!isset($user_id)){
        header('location:../login.php');
    }
    if (isset($_POST['logout'])){
        session_destroy();
        header('location:../home.php');
    }
    if (isset($_POST['submit-btn'])){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $number = mysqli_real_escape_string($conn, $_POST['number']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name='$name' AND email='$email' AND $number='$number' AND message='$message'") or die ('query failed');
        if (mysqli_num_rows($select_message)>0){
            echo 'message already send';
        }else{
            mysqli_query($conn, "INSERT INTO `message` (`user_id`, `name`, `email`, `number`, `message`) VALUES('$user_id', '$name', '$email', '$number', '$message')") or die ('query failed');
        }
    }

      //DELETE ORDER FROM DATABASE
      if (isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        
        mysqli_query($conn, "DELETE FROM `order` WHERE id = $delete_id") or die ('query failed');

        header('location:notification.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--== BOOTSTRAP ICON LINK ==-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <!--== CSS ==-->
    <link rel="stylesheet" href="../css/style2.css">

        <!----========== BOOTSTRAP CSS =============---->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">


    <title>Contact</title>
</head>
<body>
<?php include 'header.php'; ?>

<div class="banner">
            <div class="detail">
                <h1>Notification</h1>
                <a href="index.php">HOME/</a><span> NOTIFICATION</span>
            </div>
        </div>


        <!----========== SERVICES =============---->
    <div class="notif-section">
        <div class="notif-container">
                                
            <table class="table table-hover">
            <thead class="table-light">
                <tr>
                <th scope="col">Order</th>
                <th scope="col">Payment Method</th>
                <th scope="col">Price</th>
                <th scope="col">Date</th>
                <th scope="col">Order Status</th>
                </tr>
            </thead>

            <?php 
                $select_orders = mysqli_query($conn, "SELECT * FROM `order` WHERE user_id='$user_id' ORDER BY `order`.`id` DESC") or die ('query failed');
                if (mysqli_num_rows($select_orders)>0){
                    while($fetch_orders = mysqli_fetch_assoc($select_orders)){

            ?>
            
            <tr>
                <td><?php echo $fetch_orders['total_products'];?></td>
                <td><?php echo $fetch_orders['method'];?></td>
                <td><b><?php echo $fetch_orders['total_price'];?></b></td>
                <td><?php echo $fetch_orders['placed_on'];?></td>
                <td><span style="color: <?php if($fetch_orders['payment_status']=='Pending'){echo 'red';}; ?>" ><?php echo $fetch_orders['payment_status'];?></span></td>
            </tr>

            <?php 
                                 
                }
                    }else{
                echo '
                    <div class="empty">
                        <p>no order placed yet!</p>
                    </div>';
                 }
            ?>

            </table>                      
    </div>
<?php include 'footer.php'; ?>

        <!--=============== SCRIPT JS ===================-->
<script type="text/javascript" src="../js/script2.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>