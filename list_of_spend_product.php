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
        <title>List of Spend Product</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <body>
        <?php
        $sql = "SELECT * FROM spend_product";
        $query = $conn->query($sql);
        echo "<table border='1'>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Date</th>
                <th>Action</th>
            </tr>";
        while ($data = mysqli_fetch_assoc($query)) {
            $spend_product_id = $data['spend_product_id'];
            $spend_product_name = $data['spend_product_name'];
            $spend_product_qty = $data['spend_product_qty'];
            $spend_product_entrydate = $data['spend_product_entrydate'];
            echo "<tr>
                <td>$data_list[$spend_product_name]</td>
                <td>$spend_product_qty</td>
                <td>$spend_product_entrydate</td>
                <td><a href='edit_spend_product.php?id=$spend_product_id'>Edit</a></td>
            </tr>";
        }
        echo "</table>";
        ?>
    </body>

    </html>
<?php
} else {
    header('location:login.php');
}
?>