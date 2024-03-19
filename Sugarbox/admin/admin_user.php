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
        
        mysqli_query($conn, "DELETE FROM `users` WHERE id = $delete_id") or die ('query failed');
        $message[] = 'user removed succesfully';
        header('location:admin_user.php');
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
            <!--=============== TOTAL REGISTERED USER ================-->
            <section class="table-display">
            <h1 class="result">TOTAL REGISTERED USER</h1>
            <div class="scroll-table">
            <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">User Type</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>

                        <?php 
                            $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die ('query failed');
                            if (mysqli_num_rows($select_users)>0){
                                while($fetch_users = mysqli_fetch_assoc($select_users)){

                        ?>
                <tbody>
                    <tr>
                        <td><?php echo $fetch_users['id'];?></td>
                        <td><?php echo $fetch_users['name'];?></td>
                        <td><?php echo $fetch_users['email'];?></td>
                        <td><span style="color: <?php if($fetch_users['user_type']=='admin'){echo 'orange';}; ?>" ><?php echo $fetch_users['user_type'];?></span></td>
                        <td>
                        <a href="admin_user.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('delete this message?');" class="delete">delete</a>
                        </td>
                                    
                    </tr>
                </tbody>
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
            </section>

            <!--=============== REGISTERED USER ================-->
            <section class="product-display">
            <h1 class="result">TOTAL NORMAL USER</h1>
            <div class="scroll-table">
            <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">User Type</th>
                        </tr>
                    </thead>

                        <?php 
                            $select_users = mysqli_query($conn, "SELECT * FROM `users`  WHERE user_type = 'user'") or die ('query failed');
                            if (mysqli_num_rows($select_users)>0){
                                while($fetch_users = mysqli_fetch_assoc($select_users)){

                        ?>
                <tbody>
                    <tr>
                        <td><?php echo $fetch_users['id'];?></td>
                        <td><?php echo $fetch_users['name'];?></td>
                        <td><?php echo $fetch_users['email'];?></td>
                        <td><span style="color: <?php if($fetch_users['user_type']=='admin'){echo 'orange';}; ?>" ><?php echo $fetch_users['user_type'];?></span></td>
                                    
                    </tr>
                </tbody>
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
            </section>
                
            <!--=============== REGISTERED ADMIN ================-->
            <section class="product-display">
            <h1 class="result">TOTAL ADMIN ACCOUNT</h1>
            <div class="scroll-table">
            <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">User Type</th>
                        </tr>
                    </thead>

                        <?php 
                            $select_users = mysqli_query($conn, "SELECT * FROM `users`  WHERE user_type = 'admin'") or die ('query failed');
                            if (mysqli_num_rows($select_users)>0){
                                while($fetch_users = mysqli_fetch_assoc($select_users)){

                        ?>
                <tbody>
                    <tr>
                        <td><?php echo $fetch_users['id'];?></td>
                        <td><?php echo $fetch_users['name'];?></td>
                        <td><?php echo $fetch_users['email'];?></td>
                        <td><span style="color: <?php if($fetch_users['user_type']=='admin'){echo 'orange';}; ?>" ><?php echo $fetch_users['user_type'];?></span></td>
                                    
                    </tr>
                </tbody>
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
            </section>
    <div class="line"></div>
<script type="text/javascript" src="../js/script.js"></script>
</body>
</html>