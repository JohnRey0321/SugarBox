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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MY ACCOUNT</title>
</head>
<body>
 
    <?php include 'header.php'; ?>
    <div class="user-acccount"></div>

    <section class="account">

    <?php 
        $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die ('query failed!');
        if (mysqli_num_rows($select_user) > 0){
        while ($fetch_user = mysqli_fetch_assoc($select_user)){
    ?>
        <div class="info">
            <img src="../admin/image/<?php echo $fetch_user['image']; ?>">
            <h1>Hi, <?php echo $fetch_user['name'];?><h1>
            <p>Mobile: <?php echo $fetch_user['number'];?><p>
            <p>Email: <?php echo $fetch_user['email'];?><p>
        </div>

        <?php 
                                 
        }
                }else{
                }
            ?>
    </section>

















    <?php include 'footer.php'; ?>  

        <!--=============== SCRIPT JS ===================-->
    <script type="text/javascript" src="../js/script2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>