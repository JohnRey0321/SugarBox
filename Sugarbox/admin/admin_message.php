<?php 
include '../db.php';
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_name'])){
    header('location:../login.php');
    exit(); // Stop further execution
}

// Logout functionality
if (isset($_POST['logout'])){
    session_destroy();
    header('location:../login.php');
    exit(); // Stop further execution
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
    } else {
        $message[] = 'Failed to send message';
    }
}

// Delete message functionality
if (isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `user_message` WHERE id = $delete_id"); // Assuming `user_message` is the correct table
    header('location:admin_message.php');
    exit(); // Stop further execution
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

    <!--== BOOTSTRAP CSS ==-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">

    <!--== Custom CSS ==-->
    <link rel="stylesheet" href="../css/style.css">

    <title>Admin Panel</title>

    <!-- Custom CSS for message display -->
    <style>
        .message-container {
            max-width: 600px;
            margin: auto;
        }
        .message {
            margin-bottom: 10px;
        }
        .sent-message {
            border-radius: 10px;
            padding: 10px;
            margin: 10px 0;
        }
        .received-message {
            background-color: #FFFFFF;
            border-radius: 10px;
            padding: 10px;
            margin: 10px 0;
        }
    </style>

</head>
<body>
    
<?php include 'admin_header.php'; ?>

<section class="table-display">
    <h1 class="result">MESSAGE</h1>
    <div class="scroll-table">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                
            <?php 
            // Check if user ID is set before querying
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
                $select_message = mysqli_query($conn, "SELECT DISTINCT name FROM `message`") or die ('query failed');
                if (mysqli_num_rows($select_message) > 0){
                    while($fetch_message = mysqli_fetch_assoc($select_message)){
            ?>
            <tr>
                <td><?php echo $fetch_message['name'];?></td>
                <td>
                    <a href="admin_message.php?chat=<?php echo $fetch_message['name']; ?>" class="delete bi bi-reply-fill"></a></a>
                </td>               
            </tr>
            <?php 
                    }
                } else {
                    echo '<div class="empty"><p>No message!</p></div>';
                }
            } else {
                echo '<div class="empty"><p>User ID not set!</p></div>';
            }
            ?>
            </tbody>
        </table>
    </div>
</section>

<!--=========== CONVERSATION ================-->
<?php
if (isset($_GET['chat'])) {
    $message_name = $_GET['chat'];
    $message_query_admin = mysqli_query($conn, "SELECT * FROM `user_message` WHERE user_id='$user_id'") or die ('query failed');
    $message_query_user = mysqli_query($conn, "SELECT * FROM `message` WHERE user_id='$user_id' AND name='$message_name'") or die ('query failed');

    if (mysqli_num_rows($message_query_admin) > 0 || mysqli_num_rows($message_query_user) > 0 ){
?>
    <div class="message-container">
        <i class="fa-solid fa-x" id="close-form"></i>
        <h1 class="title">SugarBox</h1>
        <p>Conversation with <?php echo $message_name; ?></p>
        <?php  
        if (!empty($message)) {
            foreach($message as $msg) {
                echo '<div class="message"><span>'.$msg.'</span><i class=" bi bi-x-circle" onclick="this.parentElement.remove()"></i></div>';      
            }
        }

        while ($fetch_mess_user = mysqli_fetch_assoc($message_query_user)) {
    ?>
                <div class="convo received-message">
                    <p><?php echo $fetch_mess_user['name']; ?>:</p>
                    <h5><?php echo $fetch_mess_user['message']; ?></h5>
                </div>
    <?php
                  }
        while ($fetch_mess_admin = mysqli_fetch_assoc($message_query_admin)) {
    ?>
            <div class="convo-user sent-message">
                <p>You:</p>
                <h5><?php echo $fetch_mess_admin['message']; ?></h5>
            </div>
        <?php            
        }
        ?>

        <form method="post">
            <!--================ SUBMIT BTN ===================-->
            <div class="input-field">
                <textarea name="message" placeholder="Type here..." required></textarea>
                <button type="submit" name="submit-btn" class="message-btn bi bi-send"> </button>
            </div>
        </form>
    </div>
<?php
    }
}
echo "<script>document.querySelector('.message-container').style.display='block'</script>";
?>


<script type="text/javascript" src="../js/script.js"></script>
</body>
</html>
