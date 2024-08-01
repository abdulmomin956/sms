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
        <title>Add Spend Product</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <body>
        <?php
        if (isset($_GET["spend_product_name"])) {
            $spend_product_name = $_GET["spend_product_name"];
            $spend_product_qty = $_GET["spend_product_qty"];
            $spend_product_entrydate = $_GET["spend_product_entrydate"];

            $sql = "INSERT INTO spend_product(spend_product_name,spend_product_qty,spend_product_entrydate)
            VALUES ('$spend_product_name','$spend_product_qty','$spend_product_entrydate')";

            if ($conn->query($sql) == TRUE) {
                echo "data inserted";
            } else {
                echo "data not inserted";
            }
        }
        ?>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="get">
            Product :<br>
            <select name="spend_product_name">
                <?php
                data_list("product");
                ?>
            </select><br><br>
            Spend Quantity :<br>
            <input type="text" name="spend_product_qty"><br><br>
            Spend Entry Date :<br>
            <input type="date" name="spend_product_entrydate"><br><br>
            <input type="submit" value="submit">
        </form>
    </body>

    </html>
<?php
} else {
    header('location:login.php');
}
?>