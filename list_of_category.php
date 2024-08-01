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
        <title>List of Category</title>
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
                            $sql = "SELECT * FROM category";
                            $query = $conn->query($sql);
                            echo "<table class='table table-success table-striped table-hover'><tr><th>Category</th><th>Date</th><th>Action</th></tr>";
                            while ($data = mysqli_fetch_assoc($query)) {
                                $category_id = $data['category_id'];
                                $category_name = $data['category_name'];
                                $category_entrydate = $data['category_entrydate'];
                                echo "<tr>
                                        <td>$category_name</td>
                                        <td>$category_entrydate</td>
                                        <td><a href='edit_category.php?id=$category_id' class='btn btn-success'>Edit</a>
                                        <a href='#' class='btn btn-danger'>Delete</a></td>
                                    </tr>";
                            }
                            echo "</table>";
                            ?>

                        </div>
                    </div>
                </div>
            </div>
            <?php include('footer.php'); ?>
        </div>
    </body>

    </html>
<?php
} else {
    header('location:login.php');
}
?>