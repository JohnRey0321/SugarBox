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

// Send message functionality
if (isset($_POST['submit-btn'])){
    $admin_id = $_SESSION['admin_name'];
    $message_text = mysqli_real_escape_string($conn, $_POST['message']);

    // Get user ID from session
    $user_id = $_SESSION['user_id'];

    // Insert the message into the database with user ID
    $insert_query = mysqli_query($conn, "INSERT INTO `user_message` (`user_id`, `name`, `message`) VALUES('$user_id', '$admin_id', '$message_text')");

    if ($insert_query) {
        $message[] = 'Message sent successfully';
    } else {
        $message[] = 'Failed to send message';
    }
}

// Delete message functionality
if (isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `message` WHERE id = $delete_id");
    header('location:admin_message.php');
    exit(); // Add exit to stop further execution
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--== Box Icon Link ==-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <!----========== BOOTSTRAP CSS =============---->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">

    <!--== CSS ==-->
    <link rel="stylesheet" href="../css/style.css">

    <title>Admin Panel</title>
</head>
<body>
    
<?php include 'admin_header.php'; ?>


<div class="line4"></div>
<section class="table-display">
    <h1 class="result">MESSAGE</h1>
    <div class="scroll-table">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Message</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>

            <?php 
                $select_message = mysqli_query($conn, "SELECT * FROM `message` ORDER BY `message`.`message` ASC") or die ('query failed');
                if (mysqli_num_rows($select_message)>0){
                    while($fetch_message = mysqli_fetch_assoc($select_message)){
            ?>
            <tbody>
                <tr>
                    <td><?php echo $fetch_message['name'];?></td>
                    <td><?php echo $fetch_message['message'];?></td>
                    <td>
                        <a href="admin_message.php?chat=<?php echo $fetch_message['id']; ?>" class="delete bi bi-reply-fill"></a>
                        <a href="admin_message.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('delete this message?');" class="delete">delete</a>
                    </td>
                </tr>
            </tbody>
            <?php 
                    }
                } else {
                    echo '<div class="empty"><p>No Message!</p></div>';
                }
            ?>
        </table>
    </div>
</section>

<?php
    if (isset($_GET['chat'])) {
        $message_id = $_GET['chat'];
        $message_query = mysqli_query($conn, "SELECT * FROM `message` WHERE id = '$message_id'") or die ('query failed');
        if (mysqli_num_rows($message_query) > 0 ){
            while($fetch_mess = mysqli_fetch_assoc($message_query)){
?>
<div class="message-container">
    <i class="fa-regular fa-circle-xmark" id="close-form"></i>
    <h1 class="title">Reply</h1>
                    
    <form method="post">
        <?php  
            if (!empty($message)) {
                foreach($message as $msg) {
                    echo '<div class="message"><span>'.$msg.'</span><i class=" bi bi-x-circle" onclick="this.parentElement.remove()"></i></div>';      
                }
            }
        ?>
        <div class="input-field">
            <!-- Display admin's name instead of asking for user's name -->
            <label>Admin's Name: <b><?php echo $admin_id; ?></b></label><br>
            <!-- Remove unnecessary input fields for email and number -->
        </div>
        <div class="input-field">
            <label>Your Message</label><br>
            <textarea name="message" required></textarea>
            <button type="submit" name="submit-btn" class="message-btn">Send Message</button>
        </div>
    </form>
</div>
<?php
            }
        }
        echo "<script>document.querySelector('.message-container').style.display='block'</script>";
    }
?>
</div>
<div class="line"></div>
<script type="text/javascript" src="../js/script.js"></script>
</body>
</html>
