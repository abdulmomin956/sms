<?php
require('connection.php');
require('myFunction.php');
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
        <title>Add Store Product</title>
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
                            if (isset($_GET["store_product_name"])) {
                                $store_product_name = $_GET["store_product_name"];
                                $store_product_qty = $_GET["store_product_qty"];
                                $store_product_entrydate = $_GET["store_product_entrydate"];

                                $sql = "INSERT INTO store_product(store_product_name,store_product_qty,store_product_entrydate)
            VALUES ('$store_product_name','$store_product_qty','$store_product_entrydate')";

                                if ($conn->query($sql) == TRUE) {
                                    echo "data inserted";
                                } else {
                                    echo "data not inserted";
                                }
                            }
                            ?>
                            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="get">
                                Product :<br>
                                <select name="store_product_name">
                                    <?php
                                    data_list("product");
                                    ?>
                                </select><br><br>
                                Store Quantity :<br>
                                <input type="text" name="store_product_qty"><br><br>
                                Store Entry Date :<br>
                                <input type="date" name="store_product_entrydate"><br><br>
                                <input type="submit" value="submit" class="btn btn-success">
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