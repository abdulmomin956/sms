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
        <title>Edit Spend Product</title>
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
                                $sql = "SELECT * FROM spend_product WHERE spend_product_id=$getid";
                                $query = $conn->query($sql);
                                $data = mysqli_fetch_assoc($query);

                                $spend_product_id = $data['spend_product_id'];
                                $spend_product_name = $data['spend_product_name'];
                                $spend_product_qty = $data['spend_product_qty'];
                                $spend_product_entrydate = $data['spend_product_entrydate'];
                            }

                            if (isset($_GET['spend_product_name'])) {
                                $new_spend_product_name = $_GET['spend_product_name'];
                                $new_spend_product_qty = $_GET['spend_product_qty'];
                                $new_spend_product_entrydate =  $_GET['spend_product_entrydate'];
                                $new_spend_product_id =  $_GET['spend_product_id'];

                                $sql1 = "UPDATE spend_product SET
                                        spend_product_name='$new_spend_product_name',
                                        spend_product_qty='$new_spend_product_qty',
                                        spend_product_entrydate='$new_spend_product_entrydate' WHERE spend_product_id=$new_spend_product_id";

                                if ($conn->query($sql1) == TRUE) {
                                    echo 'Update successfull';
                                } else {
                                    echo 'not update';
                                }
                            }
                            ?>
                            <?php
                            $sql1 = "SELECT * FROM product";
                            $query1 = $conn->query($sql1);
                            ?>
                            <form action="edit_spend_product.php" method="get">
                                Product :<br>
                                <select name="spend_product_name">
                                    <?php
                                    while ($data1 = mysqli_fetch_assoc($query1)) {
                                        $product_id = $data1['product_id'];
                                        $product_name = $data1['product_name'];
                                        $isSelected = $spend_product_name == $product_id;
                                        echo "<option   value='$product_id'" ?>
                                        <?php
                                        if ($isSelected) {
                                            echo "selected";
                                        }
                                        ?>
                                    <?php echo ">$product_name</option>";
                                    }
                                    ?>
                                </select><br><br>
                                Spend Quantity :<br>
                                <input type="text" name="spend_product_qty" value="<?php echo $spend_product_qty ?>"><br><br>
                                Spend Entry Date :<br>
                                <input type="date" name="spend_product_entrydate" value="<?php echo $spend_product_entrydate ?>"><br><br>
                                <input type="text" name="spend_product_id" value="<?php echo $spend_product_id ?>" hidden>
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