<?php
require('connection.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container bg-light vh-100 d-flex justify-content-center align-items-center">
        <div class="d-flex justify-content-center align-items-center">
            <div class="d-flex justify-content-center align-items-center border border-success p-5 m-4">

                <?php
                if (isset($_POST["user_email"])) {
                    $user_email = $_POST["user_email"];
                    $user_password = $_POST["user_password"];

                    $sql = "SELECT * FROM users WHERE user_email='$user_email' AND user_password='$user_password'";
                    $query = $conn->query($sql);

                    if (mysqli_num_rows($query) > 0) {
                        $data = mysqli_fetch_array($query);
                        $user_first_name = $data['user_first_name'];
                        $user_last_name = $data['user_last_name'];

                        $_SESSION['user_first_name'] = $user_first_name;
                        $_SESSION['user_last_name'] = $user_last_name;

                        header('location:index.php');
                    } else {
                        echo "email or password wrong!";
                    }
                }

                ?>
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="d-flex flex-column justify-content-center  ">
                    User's Email :<br>
                    <input type="email" name="user_email"><br>
                    User's Password :<br>
                    <input type="password" name="user_password"><br>
                    <input type="submit" value="Login" class='btn btn-success'>
                </form>
            </div>
        </div>
    </div><!--end of body-->

</body>

</html>