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
        <title>Add Product</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <body>
        <?php
        if (isset($_GET["product_name"])) {
            $product_name = $_GET["product_name"];
            $product_category = $_GET["product_category"];
            $product_code = $_GET["product_code"];
            $product_entrydate = $_GET["product_entrydate"];

            $sql = "INSERT INTO product(product_name,product_category,product_code,product_entrydate)
            VALUES ('$product_name','$product_category','$product_code','$product_entrydate')";

            if ($conn->query($sql) == TRUE) {
                echo "data inserted";
            } else {
                echo "data not inserted";
            }
        }
        ?>
        <?php
        $sql = "SELECT * FROM category";
        $query = $conn->query($sql);
        ?>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="get">
            Product :<br>
            <input type="text" name="product_name"><br><br>
            Product Category :<br>
            <select name="product_category">
                <?php
                while ($data = mysqli_fetch_assoc($query)) {
                    $category_id = $data['category_id'];
                    $category_name = $data['category_name'];
                    echo "<option value='$category_id'>$category_name</option>";
                }
                ?>
            </select><br><br>
            Product Code :<br>
            <input type="text" name="product_code"><br><br>
            Product Entry Date :<br>
            <input type="date" name="product_entrydate"><br><br>
            <input type="submit" value="submit">
        </form>
    </body>

    </html>
<?php
} else {
    header('location:login.php');
}
?>