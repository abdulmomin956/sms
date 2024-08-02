<?php
require('connection.php');
session_start();
$user_first_name = $_SESSION['user_first_name'];
$user_last_name = $_SESSION['user_last_name'];

if (!empty($user_first_name) && !empty($user_last_name)) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Users</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <body>
        <div class="container bg-light">
            <div class="container-fluid border-bottom border-success">
                <?php include('header.php'); ?>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <?php include('sidebar.php'); ?>
                    <div class="col-sm-9 border-start border-success">
                        <div class="container p-4 m-4">

                            <?php
                            if (isset($_GET['id'])) {
                                $getid = $_GET['id'];
                                $sql = "SELECT * FROM users WHERE user_id=$getid";
                                $query = $conn->query($sql);
                                $data = mysqli_fetch_assoc($query);

                                $user_id = $data['user_id'];
                                $user_first_name = $data['user_first_name'];
                                $user_last_name = $data['user_last_name'];
                                $user_email = $data['user_email'];
                                $user_password = $data['user_password'];
                            }

                            if (isset($_GET['user_first_name'])) {
                                $new_user_first_name = $_GET['user_first_name'];
                                $new_user_last_name = $_GET['user_last_name'];
                                $new_user_email =  $_GET['user_email'];
                                $new_user_password =  $_GET['user_password'];
                                $new_user_id =  $_GET['user_id'];

                                $sql1 = "UPDATE users SET
                                        user_first_name='$new_user_first_name',
                                        user_last_name='$new_user_last_name',
                                        user_email='$new_user_email',
                                        user_password='$new_user_password' WHERE user_id=$new_user_id";

                                if ($conn->query($sql1) == TRUE) {
                                    echo 'Update successfull';
                                } else {
                                    echo 'not update';
                                }
                            }
                            ?>
                            <form action="edit_user.php" method="get">
                                First Name :<br>
                                <input type="text" name="user_first_name" value="<?php echo $user_first_name ?>"><br><br>
                                Last Name :<br>
                                <input type="text" name="user_last_name" value="<?php echo $user_last_name ?>"><br><br>
                                Email :<br>
                                <input type="text" name="user_email" value="<?php echo $user_email ?>"><br><br>
                                Password :<br>
                                <input type="text" name="user_password" value="<?php echo $user_password ?>"><br><br>
                                <input type="text" name="user_id" value="<?php echo $user_id ?>" hidden>
                                <input type="submit" value="Update" class='btn btn-success'>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <?php include('footer.php'); ?>
        </div><!--end of body-->

    </body>

    </html>
<?php
} else {
    header('location:login.php');
}
?>