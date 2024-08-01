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
        <title>Edit Category</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <body>
        <?php
        if (isset($_GET['id'])) {
            $getid = $_GET['id'];
            $sql = "SELECT * FROM category WHERE category_id=$getid";
            $query = $conn->query($sql);
            $data = mysqli_fetch_assoc($query);

            $category_id = $data['category_id'];
            $category_name = $data['category_name'];
            $category_entrydate = $data['category_entrydate'];
        }
        if (isset($_GET['category_name'])) {
            $new_category_name = $_GET['category_name'];
            $new_category_entrydate =  $_GET['category_entrydate'];
            $new_category_id =  $_GET['category_id'];

            $sql1 = "UPDATE category SET
        category_name='$new_category_name',
        category_entrydate='$new_category_entrydate' WHERE category_id=$new_category_id";

            if ($conn->query($sql1) == TRUE) {
                echo 'Update successfull';
            } else {
                echo 'not update';
            }
        }
        ?>
        <form action="edit_category.php" method="get">
            Category :<br>
            <input type="text" name="category_name" value="<?php echo $category_name ?>"><br>
            Category Entry Date :<br>
            <input type="date" name="category_entrydate" value="<?php echo $category_entrydate ?>"><br><br>
            <input type="text" name="category_id" value="<?php echo $category_id ?>" hidden>
            <input type="submit" value="Update">
        </form>
    </body>

    </html>
<?php
} else {
    header('location:login.php');
}
?>