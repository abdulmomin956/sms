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
        <title>Edit Store Product</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <body>
        <?php
        if (isset($_GET['id'])) {
            $getid = $_GET['id'];
            $sql = "SELECT * FROM store_product WHERE store_product_id=$getid";
            $query = $conn->query($sql);
            $data = mysqli_fetch_assoc($query);

            $store_product_id = $data['store_product_id'];
            $store_product_name = $data['store_product_name'];
            $store_product_qty = $data['store_product_qty'];
            $store_product_entrydate = $data['store_product_entrydate'];
        }

        if (isset($_GET['store_product_name'])) {
            $new_store_product_name = $_GET['store_product_name'];
            $new_store_product_qty = $_GET['store_product_qty'];
            $new_store_product_entrydate =  $_GET['store_product_entrydate'];
            $new_store_product_id =  $_GET['store_product_id'];

            $sql1 = "UPDATE store_product SET
        store_product_name='$new_store_product_name',
        store_product_qty='$new_store_product_qty',
        store_product_entrydate='$new_store_product_entrydate' WHERE store_product_id=$new_store_product_id";

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
        <form action="edit_store_product.php" method="get">
            Product :<br>
            <select name="store_product_name">
                <?php
                while ($data1 = mysqli_fetch_assoc($query1)) {
                    $product_id = $data1['product_id'];
                    $product_name = $data1['product_name'];
                    $isSelected = $store_product_name == $product_id;
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
            Store Quantity :<br>
            <input type="text" name="store_product_qty" value="<?php echo $store_product_qty ?>"><br><br>
            Store Entry Date :<br>
            <input type="date" name="store_product_entrydate" value="<?php echo $store_product_entrydate ?>"><br><br>
            <input type="text" name="store_product_id" value="<?php echo $store_product_id ?>" hidden>
            <input type="submit" value="Update">
        </form>
    </body>

    </html>
<?php
} else {
    header('location:login.php');
}
?>