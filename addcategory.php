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
        <title>Add Category</title>
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
                            if (isset($_GET["category_name"])) {
                                $category_name = $_GET["category_name"];
                                $category_entrydate = $_GET["category_entrydate"];

                                $sql = "INSERT INTO category(category_name,category_entrydate)
                                    VALUES ('$category_name','$category_entrydate')";

                                if ($conn->query($sql) == TRUE) {
                                    echo "data inserted";
                                } else {
                                    echo "data not inserted";
                                }
                            }
                            ?>
                            <form action="addcategory.php" method="get">
                                Category :<br>
                                <input type="text" name="category_name"><br>
                                Category Entry Date :<br>
                                <input type="date" name="category_entrydate"><br><br>
                                <input type="submit" value="submit" class="btn btn-success">
                            </form>
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