<?php
require('connection.php');
$sql1 = "SELECT * FROM category";
$query1 = $conn->query($sql1);

$data_list = array();

while ($data1 = mysqli_fetch_assoc($query1)) {
    $category_id = $data1['category_id'];
    $category_name = $data1['category_name'];

    $data_list[$category_id] = $category_name;
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
        <title>List of Product</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <body>
        <?php
        $sql = "SELECT * FROM product";
        $query = $conn->query($sql);
        echo "<table border='1'>
            <tr>
                <th>Product</th>
                <th>Category</th>
                <th>Code</th>
                <th>Date</th>
                <th>Action</th>
            </tr>";
        while ($data = mysqli_fetch_assoc($query)) {
            $product_id = $data['product_id'];
            $product_name = $data['product_name'];
            $product_category = $data['product_category'];
            $product_code = $data['product_code'];
            $product_entrydate = $data['product_entrydate'];
            echo "<tr>
                <td>$product_name</td>
                <td>$data_list[$product_category]</td>
                <td>$product_code</td>
                <td>$product_entrydate</td>
                <td><a href='edit_product.php?id=$product_id'>Edit</a></td>
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