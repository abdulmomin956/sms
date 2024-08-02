<?php
require('connection.php');
$sql1 = "SELECT * FROM product";
$query1 = $conn->query($sql1);

$data_list = array();

while ($data1 = mysqli_fetch_assoc($query1)) {
    $product_id = $data1['product_id'];
    $product_name = $data1['product_name'];

    $data_list[$product_id] = $product_name;
}

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
        <title>List of Store Product</title>
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
                            $sql = "SELECT * FROM store_product";
                            $query = $conn->query($sql);
                            echo "<table class='table table-success table-striped table-hover'>
                                    <tr>
                                        <th>Product</th>
                                        <th>Store Quantity</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>";
                            while ($data = mysqli_fetch_assoc($query)) {
                                $store_product_id = $data['store_product_id'];
                                $store_product_name = $data['store_product_name'];
                                $store_product_qty = $data['store_product_qty'];
                                $store_product_entrydate = $data['store_product_entrydate'];
                                echo "<tr>
                                        <td>$data_list[$store_product_name]</td>
                                        <td>$store_product_qty</td>
                                        <td>$store_product_entrydate</td>
                                        <td>
                                            <a href='edit_store_product.php?id=$store_product_id' class='btn btn-success'>Edit</a>
                                            <a href='#' class='btn btn-danger'>Delete</a>
                                        </td>
                                    </tr>";
                            }
                            echo "</table>";
                            ?>

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