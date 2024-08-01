<?php
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
        <title>Store Management System | SMS</title>
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
                        <div class="row p-4">
                            <div class="col-sm-3">
                                <a href="addcategory.php"> <i class="fas fa-folder-plus fa-5x text-success"></i></a>
                                <p>Add Category</p>
                            </div>
                            <div class="col-sm-3">
                                <a href="list_of_category.php"> <i class="fas fa-folder-open fa-5x text-success"></i></a>
                                <p>Category List</p>
                            </div>
                            <div class="col-sm-3">
                                <a href="add_product.php"> <i class="fas fa-box-open fa-5x text-success"></i></a>
                                <p>Add Product</p>
                            </div>
                            <div class="col-sm-3">
                                <a href="list_of_product.php"> <i class="fas fa-stream fa-5x text-success"></i></a>
                                <p>Product List</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row p-4">
                            <div class="col-sm-3">
                                <a href="add_store_product.php"> <i class="fas fa-trash-restore fa-5x text-success"></i></a>
                                <p>Store Product</p>
                            </div>
                            <div class="col-sm-3">
                                <a href="list_of_store_product.php"> <i class="fas fa-box fa-5x text-success"></i></a>
                                <p>Store Product List</p>
                            </div>
                            <div class="col-sm-3">
                                <a href="add_spend_product.php"> <i class="fas fa-plus-circle fa-5x text-success"></i></a>
                                <p>Spend Product</p>
                            </div>
                            <div class="col-sm-3">
                                <a href="list_of_spend_product.php"> <i class="fas fa-window-restore fa-5x text-success"></i></a>
                                <p>Spend Product List</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row p-4">
                            <div class="col-sm-3">
                                <a href="report.php"> <i class="fas fa-chart-bar fa-5x text-success"></i></a>
                                <p>Report</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row p-4">
                            <div class="col-sm-3">
                                <a href="add_user.php"> <i class="fas fa-user-plus fa-5x text-success"></i></a>
                                <p>Add User</p>
                            </div>
                            <div class="col-sm-3">
                                <a href="list_of_user.php"> <i class="fas fa-users fa-5x text-success"></i></a>
                                <p>User List</p>
                            </div>
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