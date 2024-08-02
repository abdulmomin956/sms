<?php
require('connection.php');
function proName($id)
{
    require('connection.php');
    $sql1 = "SELECT product_name FROM product WHERE product_id=$id";
    $query1 = $conn->query($sql1);
    $data1 = mysqli_fetch_assoc($query1);
    return $data1['product_name'];
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
        <title>Report</title>
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

                            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="get">
                                Select Product Name :
                                <select name="product_id">
                                    <?php
                                    $sql = "SELECT * FROM product";
                                    $query = $conn->query($sql);

                                    while ($data = mysqli_fetch_assoc($query)) {
                                        $product_id = $data['product_id'];
                                        $product_name = $data['product_name'];

                                        echo "<option value=$product_id>$product_name</option>";
                                    }
                                    ?>
                                </select>
                                <input type="submit" value="Generate Report" class='btn btn-success'>
                            </form>

                            <h1>Store Product</h1>
                            <?php
                            if (isset($_GET['product_id'])) {
                                $product_id = $_GET['product_id'];
                                $stoSql = "SELECT * FROM store_product WHERE store_product_name='$product_id'";
                                $stoQuery = $conn->query($stoSql);
                                proName($product_id);
                                if ($stoarr = mysqli_fetch_array($stoQuery)) {
                                    $store_qty = $stoarr['store_product_qty'];
                                    $store_entrydate = $stoarr['store_product_entrydate'];
                                    echo "<h2>";
                                    echo proName($product_id);
                                    echo "</h2>";
                                    echo "<table class='table table-success table-striped table-hover'><tr><th>Store Date</th><th>Amount</th></tr>";
                                    echo "<tr><td>$store_entrydate</td><td>$store_qty</td></tr>";
                                    echo "</table>";
                                }
                            }
                            ?>
                            <h1>Spend Product</h1>
                            <?php
                            if (isset($_GET['product_id'])) {
                                $product_id = $_GET['product_id'];
                                $speSql = "SELECT * FROM spend_product WHERE spend_product_name='$product_id'";
                                $speQuery = $conn->query($speSql);
                                if ($spearr = mysqli_fetch_array($speQuery)) {
                                    $spend_qty = $spearr['spend_product_qty'];
                                    $spend_entrydate = $spearr['spend_product_entrydate'];
                                    echo "<h2>";
                                    echo proName($product_id);
                                    echo "</h2>";
                                    echo "<table class='table table-success table-striped table-hover'><tr><th>Spend Date</th><th>Amount</th></tr>";
                                    echo "<tr><td>$store_entrydate</td><td>$spend_qty</td></tr>";
                                    echo "</table>";
                                }
                            }
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