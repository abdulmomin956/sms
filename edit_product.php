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
        <title>Edit Product</title>
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
                                $sql = "SELECT * FROM product WHERE product_id=$getid";
                                $query = $conn->query($sql);
                                $data = mysqli_fetch_assoc($query);

                                $product_id = $data['product_id'];
                                $product_name = $data['product_name'];
                                $product_category = $data['product_category'];
                                $product_code = $data['product_code'];
                                $product_entrydate = $data['product_entrydate'];
                            }

                            if (isset($_GET['product_name'])) {
                                $new_product_name = $_GET['product_name'];
                                $new_product_category = $_GET['product_category'];
                                $new_product_code = $_GET['product_code'];
                                $new_product_entrydate =  $_GET['product_entrydate'];
                                $new_product_id =  $_GET['product_id'];

                                $sql1 = "UPDATE product SET
                                        product_name='$new_product_name',
                                        product_category='$new_product_category',
                                        product_code='$new_product_code',
                                        product_entrydate='$new_product_entrydate' WHERE product_id=$new_product_id";

                                if ($conn->query($sql1) == TRUE) {
                                    echo 'Update successfull';
                                } else {
                                    echo 'not update';
                                }
                            }
                            ?>
                            <?php
                            $sql1 = "SELECT * FROM category";
                            $query1 = $conn->query($sql1);
                            ?>
                            <form action="edit_product.php" method="get">
                                Product :<br>
                                <input type="text" name="product_name" value="<?php echo $product_name ?>"><br><br>
                                Product Category :<br>
                                <select name="product_category">
                                    <?php
                                    while ($data1 = mysqli_fetch_assoc($query1)) {
                                        $category_id = $data1['category_id'];
                                        $category_name = $data1['category_name'];
                                        $isSelected = $product_category == $category_id;
                                        echo  $product_category == $category_id;
                                        echo "<option   value='$category_id'" ?>
                                        <?php
                                        if ($isSelected) {
                                            echo "selected";
                                        }
                                        ?>
                                    <?php echo ">$category_name</option>";
                                    }
                                    ?>
                                </select><br><br>
                                Product Code :<br>
                                <input type="text" name="product_code" value="<?php echo $product_code ?>"><br><br>
                                Product Entry Date :<br>
                                <input type="date" name="product_entrydate" value="<?php echo $product_entrydate ?>"><br><br>
                                <input type="text" name="product_id" value="<?php echo $product_id ?>" hidden>
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